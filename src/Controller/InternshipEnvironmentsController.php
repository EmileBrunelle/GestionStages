<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\EmployersTable;
use App\Model\Table\EstablishmentTypesTable;
use App\Model\Table\CustomerTypesTable;
use App\Model\Table\EnvironmentMissionsTable;
use Cake\ORM\Entity;

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
                $employer = $this->InternshipEnvironments->Employers->findById($id)->first();
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
                $employer = $this->InternshipEnvironments->Employers->findById($id)->first();
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
                $employer = $this->InternshipEnvironments->Employers->findById($id)->first();
                return $employer->id_user === $user['id'];
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
        $this->paginate = [
            'contain' => ['Employers']
        ];
        $internshipEnvironments = $this->paginate($this->InternshipEnvironments);

        $this->set(compact('internshipEnvironments'));
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
            'contain' => ['Employers', 'Customer_types']
        ]);

        $this->set('internshipEnvironment', $internshipEnvironment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$this->loadModel('Customer_types');

        $internshipEnvironment = $this->InternshipEnvironments->newEntity();
        if ($this->request->is('post')) {

            $internshipEnvironment = $this->InternshipEnvironments->patchEntity($internshipEnvironment, $this->request->getData());

            /*
            $Customer_type_save = [];

            foreach($internshipEnvironment->Customer_types as $Customer_type){
                $Customer_type_entity = $this->InternshipEnvironments->Customer_types->newEntity();
                $Customer_type_entity -> id = $Customer_type;


                $Customer_type_save[] = $Customer_type_entity;
            }


            $internshipEnvironment->Customer_types = $Customer_type_save;
            */

            if ($this->InternshipEnvironments->save($internshipEnvironment)) {
                $this->Flash->success(__('The internship environment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship environment could not be saved. Please, try again.'));
        }
        $employers = $this->InternshipEnvironments->Employers->find('list', ['limit' => 200]);
        $Establishment_types = $this->InternshipEnvironments->Establishment_types->Find('list', ['limit' => 200]);
        $Customer_types = $this->InternshipEnvironments->Customer_types->Find('list', ['limit' => 200]);
        $Environment_missions = $this->InternshipEnvironments->Environment_missions->Find('list', ['limit' => 200]);


        $this->set(compact('internshipEnvironment', 'employers', 'Establishment_types', 'Customer_types',
                                    'Environment_missions'));
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
