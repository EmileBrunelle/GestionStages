<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\EmployersTable;
use App\Model\Table\EstablishmentTypesTable;
use App\Model\Table\CustomerTypesTable;
use App\Model\Table\EnvironmentMissionsTable;
use App\Model\Entity\Employer;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * InternshipEnvironments Controller
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable $InternshipEnvironments
 *
 * @method \App\Model\Entity\InternshipEnvironment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InternshipEnvironmentsController extends AppController
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
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $internshipEnvironment = $this->InternshipEnvironments->findById($id)->first();
                $employer = $this->InternshipEnvironments->Employers->findById($internshipEnvironment['employer_id'])->first();
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
                $internshipEnvironment = $this->InternshipEnvironments->findById($id)->first();
                $employer = $this->InternshipEnvironments->Employers->findById($internshipEnvironment['employer_id'])->first();
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
        $requiresProfile = false;

        $employer_id = 0;
        $roleuser = $this->Auth->user('role');
        $iduser = $this->Auth->user('id');

        if ($roleuser === 'employer'){
            //Set employer object based on user profile to check if they need a new profile
            $employer = $this->InternshipEnvironments->Employers->findByIdUser($iduser)->first();

            if ($employer === null){
                $requiresProfile = true;
            }
        }

        //Check if user is employer and assign an employer id variable to filter results
        if (isset($iduser)){
            if (isset($roleuser)) {
                if ($roleuser === 'employer') {
                    $iduser = $this->Auth->user('id');
                    $employer = $this->InternshipEnvironments->Employers->findByIdUser($iduser)->first();
                    if ($employer != null){
                        $employer_id = $employer->get('id');
                    }


                    $this->paginate = [
                        'conditions' => ['Employers.id IN' => $employer_id],
                        'contain' => ['Employers']
                    ];

                } else if ($roleuser === 'admin' || $roleuser === 'coordinator') {
                    $this->paginate = [
                        'contain' => ['Employers']
                    ];
                } else {
                    $this->paginate = [
                        'conditions' => ['Employers.id IN' => $employer_id],
                        'contain' => ['Employers']
                    ];
                }
            }
        } else {
            $this->paginate = [
                'conditions' => ['Employers.id IN' => $employer_id],
                'contain' => ['Employers']
            ];
        }

        $internshipEnvironments = $this->paginate($this->InternshipEnvironments);

        $this->set(compact('internshipEnvironments', 'roleuser', 'requiresProfile'));
    }

    /**
     * View method
     *
     * @param string|null $id Internship Environment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $internshipEnvironment = $this->InternshipEnvironments->get($id, [
            'contain' => ['Employers', 'establishment_types', 'Customer_types', 'Environment_missions']
        ]);

        $roleuser = $this->Auth->user('role');

        /*
        $types = $internshipEnvironment->Customer_types->Find('list', ['limit' => 200]);
        debug($types);
        */

        $this->set('internshipEnvironment', $internshipEnvironment);
        $this->set(compact('roleuser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $internshipEnvironment = $this->InternshipEnvironments->newEntity();
        if ($this->request->is('post')) {
            $internshipEnvironment = $this->InternshipEnvironments->patchEntity($internshipEnvironment, $this->request->getData());

            if ($this->InternshipEnvironments->save($internshipEnvironment)) {
                $this->Flash->success(__('The internship environment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship environment could not be saved. Please, try again.'));
        }

        $id_user = $this->Auth->user('id');

        $role_user = $this->Auth->user('role');

        if ($role_user === 'coordinator' || $role_user === 'admin'){
            $employers = $this->InternshipEnvironments->Employers->find('list', ['limit' => 200]);
        } else {
            $employer = $this->InternshipEnvironments->Employers->findByIdUser($id_user)->first();
            $employer_id = $employer->get('id');
        }


        $Establishment_types = $this->InternshipEnvironments->Establishment_types->Find('list', ['limit' => 200]);
        $Customer_types = $this->InternshipEnvironments->Customer_types->Find('list', ['limit' => 200]);
        $Environment_missions = $this->InternshipEnvironments->Environment_missions->Find('list', ['limit' => 200]);

        $this->set(compact('internshipEnvironment', 'employer_id', 'employers', 'Establishment_types', 'Customer_types',
                                    'Environment_missions', 'role_user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Internship Environment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $internshipEnvironment = $this->InternshipEnvironments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $internshipEnvironment = $this->InternshipEnvironments->patchEntity($internshipEnvironment, $this->request->getData());
            if ($this->InternshipEnvironments->save($internshipEnvironment)) {
                $this->Flash->success(__('The internship environment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship environment could not be saved. Please, try again.'));
        }
        $employers = $this->InternshipEnvironments->Employers->find('list', ['limit' => 200]);
        $this->set(compact('internshipEnvironment', 'employers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Internship Environment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $internshipEnvironment = $this->InternshipEnvironments->get($id);
        if ($this->InternshipEnvironments->delete($internshipEnvironment)) {
            $this->Flash->success(__('The internship environment has been deleted.'));
        } else {
            $this->Flash->error(__('The internship environment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
