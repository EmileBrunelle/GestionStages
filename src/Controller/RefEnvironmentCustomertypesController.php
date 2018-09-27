<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RefEnvironmentCustomertypes Controller
 *
 * @property \App\Model\Table\RefEnvironmentCustomertypesTable $RefEnvironmentCustomertypes
 *
 * @method \App\Model\Entity\RefEnvironmentCustomertype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RefEnvironmentCustomertypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InternshipEnvironments', 'CustomerTypes']
        ];
        $refEnvironmentCustomertypes = $this->paginate($this->RefEnvironmentCustomertypes);

        $this->set(compact('refEnvironmentCustomertypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Ref Environment Customertype id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->get($id, [
            'contain' => ['InternshipEnvironments', 'CustomerTypes']
        ]);

        $this->set('refEnvironmentCustomertype', $refEnvironmentCustomertype);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->newEntity();
        if ($this->request->is('post')) {
            $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->patchEntity($refEnvironmentCustomertype, $this->request->getData());
            if ($this->RefEnvironmentCustomertypes->save($refEnvironmentCustomertype)) {
                $this->Flash->success(__('The ref environment customertype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref environment customertype could not be saved. Please, try again.'));
        }
        $internshipEnvironments = $this->RefEnvironmentCustomertypes->InternshipEnvironments->find('list', ['limit' => 200]);
        $customerTypes = $this->RefEnvironmentCustomertypes->CustomerTypes->find('list', ['limit' => 200]);
        $this->set(compact('refEnvironmentCustomertype', 'internshipEnvironments', 'customerTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ref Environment Customertype id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->patchEntity($refEnvironmentCustomertype, $this->request->getData());
            if ($this->RefEnvironmentCustomertypes->save($refEnvironmentCustomertype)) {
                $this->Flash->success(__('The ref environment customertype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref environment customertype could not be saved. Please, try again.'));
        }
        $internshipEnvironments = $this->RefEnvironmentCustomertypes->InternshipEnvironments->find('list', ['limit' => 200]);
        $customerTypes = $this->RefEnvironmentCustomertypes->CustomerTypes->find('list', ['limit' => 200]);
        $this->set(compact('refEnvironmentCustomertype', 'internshipEnvironments', 'customerTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ref Environment Customertype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $refEnvironmentCustomertype = $this->RefEnvironmentCustomertypes->get($id);
        if ($this->RefEnvironmentCustomertypes->delete($refEnvironmentCustomertype)) {
            $this->Flash->success(__('The ref environment customertype has been deleted.'));
        } else {
            $this->Flash->error(__('The ref environment customertype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
