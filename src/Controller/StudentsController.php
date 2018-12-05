<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 *
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{

    public function isAuthorized($user)
    {
        if ($user['role'])
            $action = $this->request->getParam('action');

        if (in_array($action, ['add'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'student') {

                $student = $this->Students->findByIdUser($user['id'])->first();

                if ($student === null){
                    return true;
                }
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }
        }

        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'student') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $student = $this->Students->findById($id)->first();
                return $student->id_user === $user['id'];
            }
        }

        if (in_array($action, ['edit', 'uploadFile'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'student') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $student = $this->Students->findById($id)->first();
                return $student->id_user === $user['id'];
            }
        }

        if (in_array($action, ['delete'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $students = $this->paginate($this->Students);

        $this->set(compact('students'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['files']
        ]);

        $this->set('student', $student);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['controller' => 'Internships', 'action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }

        $id_user = $this->Auth->user('id');

        $this->set(compact('student', 'id_user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $this->set(compact('student'));
    }

    public function uploadFile($id = null)
    {
        $this->Students->FilesStudents = TableRegistry::getTableLocator()->get('FilesStudents');
        $student = $this->Students->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($file = $this->addFile()) {
                $this->request->is('post');
                $file->_joinData = $this->Students->FilesStudents->newEntity();
                $this->Students->Files->link($student, [$file]);
            }
        }
        $this->set(compact('student'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function sendEmail($id = null, $employer) {
        $student = $this->Students->get($id);
        $email = new Email();
        $email
            ->setSubject(__('{0} wants to meet you', $employer->name))
            ->setEmailFormat('both')
            ->addTo($student->email)
            ->setFrom($employer->email)
            ->message(__('We looked at your candidacy and were interested in meeting you. If you are interested as well, please reply to this email and we\'ll arrange a meeting.'))
            ->send();
    }

    private function addFile() {
        $type = explode(".", $this->request->data['file']['name'])[1];
        if ($this->request->data['file']['type'] == 'application/pdf' || $type == 'docx') {
            $this->Files = TableRegistry::getTableLocator()->get('Files');
            $file = $this->Files->newEntity();
            if (!empty($this->request->data['file']['name'])) {
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'Students/';
                $uploadFile = $uploadPath . $fileName;
                if (move_uploaded_file($this->request->data['file']['tmp_name'], 'img/' . $uploadFile)) {
                    $file = $this->Files->patchEntity($file, $this->request->getData());
                    $file->name = $fileName;
                    $file->path = $uploadPath;
                    if ($this->Files->save($file)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                        return $file;
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        } else {
            $this->Flash->error(__('The file must be a PDF or a DOCX.'));
        }
    }

}
