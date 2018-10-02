<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employers Controller
 *
 * @property \App\Model\Table\EmployersTable $Employers
 *
 * @method \App\Model\Entity\Employer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployersController extends AppController
{

    public function isAuthorized($user)
    {
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
                $employer = $this->Employers->findByIdUser($user['id'])->first();

                if ($employer === null){
                    return true;
                }
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
                return false;
            }

            if (isset($user['role']) && $user['role'] === 'employer') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $employer = $this->Employers->findById($id)->first();
                return $employer->id_user === $user['id'];
            }
        }

        if (in_array($action, ['edit'])) {
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
                $employer = $this->Employers->findById($id)->first();
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
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $isAdmin = false;
        $requiresProfile = false;

        $iduser = $this->Auth->user('id');
        $roleuser = $this->Auth->user('role');

        if ($roleuser === 'admin' || $roleuser === 'coordinator'){
            $isAdmin = true;
        }

        if ($roleuser === 'employer'){
            //Set employer object based on user profile to check if they need a new profile
            $employer = $this->Employers->findByIdUser($iduser)->first();

            if ($employer === null){
                $requiresProfile = true;
            }
        }


        $employers = $this->paginate($this->Employers);
        $this->set(compact('employers', 'requiresProfile', 'isAdmin'));
    }

    /**
     * View method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employer = $this->Employers->get($id, [
            'contain' => ['InternshipEnvironments']
        ]);

        $this->set('employer', $employer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employer = $this->Employers->newEntity();
        if ($this->request->is('post')) {
            $employer = $this->Employers->patchEntity($employer, $this->request->getData());
            if ($this->Employers->save($employer)) {
                $this->Flash->success(__('The employer has been saved.'));

                return $this->redirect(['controller' => 'InternshipEnvironments', 'action' => 'index']);
            }
            $this->Flash->error(__('The employer could not be saved. Please, try again.'));
        }

        $id_user = $this->Auth->user('id');
        $role_user = $this->Auth->user('role');

        $this->set(compact('employer', 'id_user', 'role_user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employer = $this->Employers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employer = $this->Employers->patchEntity($employer, $this->request->getData());
            if ($this->Employers->save($employer)) {
                $this->Flash->success(__('The employer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employer could not be saved. Please, try again.'));
        }

        //Get a list of users
        $role = $this->Auth->user('role');

        if ($role === 'coordinator' || $role === 'admin'){
            $this->loadModel('Users');
            $users = $this->Users->find('list')
                ->where(['role IN' => 'employer'])->toArray();
        }


        $this->set(compact('employer', 'users', 'role'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employer = $this->Employers->get($id);
        if ($this->Employers->delete($employer)) {
            $this->Flash->success(__('The employer has been deleted.'));
        } else {
            $this->Flash->error(__('The employer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
