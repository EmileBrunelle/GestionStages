<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RefEnvironmentMissions Controller
 *
 * @property \App\Model\Table\RefEnvironmentMissionsTable $RefEnvironmentMissions
 *
 * @method \App\Model\Entity\RefEnvironmentMission[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RefEnvironmentMissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InternshipEnvironments', 'EnvironmentMissions']
        ];
        $refEnvironmentMissions = $this->paginate($this->RefEnvironmentMissions);

        $this->set(compact('refEnvironmentMissions'));
    }

    /**
     * View method
     *
     * @param string|null $id Ref Environment Mission id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $refEnvironmentMission = $this->RefEnvironmentMissions->get($id, [
            'contain' => ['InternshipEnvironments', 'EnvironmentMissions']
        ]);

        $this->set('refEnvironmentMission', $refEnvironmentMission);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $refEnvironmentMission = $this->RefEnvironmentMissions->newEntity();
        if ($this->request->is('post')) {
            $refEnvironmentMission = $this->RefEnvironmentMissions->patchEntity($refEnvironmentMission, $this->request->getData());
            if ($this->RefEnvironmentMissions->save($refEnvironmentMission)) {
                $this->Flash->success(__('The ref environment mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref environment mission could not be saved. Please, try again.'));
        }
        $internshipEnvironments = $this->RefEnvironmentMissions->InternshipEnvironments->find('list', ['limit' => 200]);
        $environmentMissions = $this->RefEnvironmentMissions->EnvironmentMissions->find('list', ['limit' => 200]);
        $this->set(compact('refEnvironmentMission', 'internshipEnvironments', 'environmentMissions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ref Environment Mission id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $refEnvironmentMission = $this->RefEnvironmentMissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $refEnvironmentMission = $this->RefEnvironmentMissions->patchEntity($refEnvironmentMission, $this->request->getData());
            if ($this->RefEnvironmentMissions->save($refEnvironmentMission)) {
                $this->Flash->success(__('The ref environment mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref environment mission could not be saved. Please, try again.'));
        }
        $internshipEnvironments = $this->RefEnvironmentMissions->InternshipEnvironments->find('list', ['limit' => 200]);
        $environmentMissions = $this->RefEnvironmentMissions->EnvironmentMissions->find('list', ['limit' => 200]);
        $this->set(compact('refEnvironmentMission', 'internshipEnvironments', 'environmentMissions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ref Environment Mission id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $refEnvironmentMission = $this->RefEnvironmentMissions->get($id);
        if ($this->RefEnvironmentMissions->delete($refEnvironmentMission)) {
            $this->Flash->success(__('The ref environment mission has been deleted.'));
        } else {
            $this->Flash->error(__('The ref environment mission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
