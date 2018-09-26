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
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $employers = $this->paginate($this->Employers);

        $this->set(compact('employers'));
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employer could not be saved. Please, try again.'));
        }
        $this->set(compact('employer'));
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
        $this->set(compact('employer'));
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
