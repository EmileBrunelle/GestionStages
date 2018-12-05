<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Model\Table\InternshipEnvironmentsTable;
use App\Model\Entity\InternshipEnvironment;
use Cake\ORM\TableRegistry;

/**
 * Internships Controller
 *
 * @property \App\Model\Table\InternshipsTable $Internships
 *
 * @method \App\Model\Entity\Internship[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InternshipsController extends AppController
{
    public function isAuthorized($user) {
        if ($user['role'])
            $action = $this->request->getParam('action');

        if (in_array($action, ['add'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'employer') {
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

            if (isset($user['role']) && $user['role'] === 'employer') {
                return true;
            }
        }

        if (in_array($action, ['edit'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'student') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'employer') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $internship = $this->Internships->findById($id)->first();
                $internshipEnvironment = $this->Internships->InternshipEnvironments->findById($internship['environment_id'])->first();
                $employer = $this->Internships->InternshipEnvironments->Employers->findById($internshipEnvironment['employer_id'])->first();
                return $employer->id_user === $user['id'];
            }
        }

        if (in_array($action, ['delete'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'employer') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $internship = $this->Internships->findById($id)->first();
                $internshipEnvironment = $this->Internships->InternshipEnvironments->findById($internship['environment_id'])->first();
                $employer = $this->Internships->InternshipEnvironments->Employers->findById($internshipEnvironment['employer_id'])->first();
                return $employer->id_user === $user['id'];
            }
        }

        if (in_array($action, ['application'])) {
            if (isset($user['role']) && $user['role'] === 'student') {
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
        $roleuser = $this->Auth->user('role');

        if($roleuser === 'employer') {
            $user_id = $this->Auth->user('id');
            $this->Employers = TableRegistry::getTableLocator()->get('Employers');

            $employer = $this->Employers->findByIdUser($user_id)->first();
            $employer_id = $employer['id'];

            $this->paginate = [
                'conditions' => ['InternshipEnvironments.employer_id IN' => $employer_id],
                'contain' => ['InternshipEnvironments']
            ];
        } else {
            $this->paginate = [
                'contain' => ['InternshipEnvironments']
            ];
        }

        $internships = $this->paginate($this->Internships);


        $this->set(compact('internships', 'roleuser'));
    }

    /**
     * View method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $internship = $this->Internships->get($id, [
            'contain' => ['InternshipEnvironments', 'Students']
        ]);

        $this->set('internship', $internship);

        $eid = $internship->internship_environment->get('employer_id');

        $employer = $this->Internships->InternshipEnvironments->Employers->findById($eid)->first();

        $this->set(compact('employer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $internship = $this->Internships->newEntity();
        if ($this->request->is('post')) {
            $internship = $this->Internships->patchEntity($internship, $this->request->getData());
            if ($this->Internships->save($internship)) {
                $this->Flash->success(__('The internship has been saved.'));

                $id = $internship->get('id');
                return $this->redirect(['controller' => 'emails', 'action' => 'notifyAll', '?'=>['id'=>$id]]);
            }
            $this->Flash->error(__('The internship could not be saved. Please, try again.'));
        }

        $iduser = $this->Auth->user('id');

        $roleuser = $this->Auth->user('role');
        if ($roleuser === 'employer') {
            $employerQuery = $this->Internships->InternshipEnvironments->Employers->find('all')->where(['id_user' => $iduser]);
            $employerResult = $employerQuery->first();
            $employerID = $employerResult->get('id');

            $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list')
                ->where(['employer_id IN' => $employerID])->toArray();
        }

        if ($roleuser === 'admin' || $roleuser === 'coordinator'){
            $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list');
        }

        $this->set(compact('internship', 'internshipEnvironments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $internship = $this->Internships->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $internship = $this->Internships->patchEntity($internship, $this->request->getData());
            if ($this->Internships->save($internship)) {
                $this->Flash->success(__('The internship has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship could not be saved. Please, try again.'));
        }

        $iduser = $this->Auth->user('id');

        $roleuser = $this->Auth->user('role');
        if ($roleuser === 'employer'){
            $employerQuery = $this->Internships->InternshipEnvironments->Employers->find('all')->where(['id_user' => $iduser]);
            $employerResult = $employerQuery->first();
            $employerID = $employerResult->get('id');

            $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list')
                ->where(['employer_id IN' => $employerID])->toArray();
        }

        if ($roleuser === 'admin' || $roleuser === 'coordinator'){
            $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list');
        }


        $this->set(compact('internship', 'internshipEnvironments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Internship id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $internship = $this->Internships->get($id);
        if ($this->Internships->delete($internship)) {
            $this->Flash->success(__('The internship has been deleted.'));
        } else {
            $this->Flash->error(__('The internship could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function application($id = null)
    {
        $user = $this->Auth->user();
        $student = $this->Internships->students->findByIdUser($user['id'])->first();

        $internships_students = TableRegistry::get('Internships_Students');

        $data = [
            'internship_id' => $id,
            'student_id' => $student['id']
        ];

        if ($data['student_id'] == null){
            $this->Flash->error(__('An error occured when applying to this internship.'));
            return $this->redirect(['action' => 'index']);
        }

        $internship_student = $internships_students->newEntity();
        $internship_student = $internships_students->patchEntity($internship_student, $data);

        if ($internships_students->save($internship_student)){
            $this->Flash->success(__('You have succesfully applied on this internship.'));
        } else {
            $this->Flash->error(__('An error occured when applying to this internship.'));
        }

        $id = $this->request->getParam('pass.0');

        if (!$id) {
            return false;
        }

        $internship = $this->Internships->findById($id)->first();
        $internshipEnvironment = $this->Internships->InternshipEnvironments->findById($internship['environment_id'])->first();
        $employer = $this->Internships->InternshipEnvironments->Employers->findById($internshipEnvironment['employer_id'])->first();

        return $this->redirect(['controller' => 'emails', 'action' => 'notifyEmployer', '?' => ['eid' => $employer['id'], 'iid' => $internship['id']]]);
    }



}
