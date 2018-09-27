<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnvironmentMissions Controller
 *
 * @property \App\Model\Table\EnvironmentMissionsTable $EnvironmentMissions
 *
 * @method \App\Model\Entity\EnvironmentMission[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnvironmentMissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $environmentMissions = $this->paginate($this->EnvironmentMissions);

        $this->set(compact('environmentMissions'));
    }

    /**
     * View method
     *
     * @param string|null $id Environment Mission id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $environmentMission = $this->EnvironmentMissions->get($id, [
            'contain' => []
        ]);

        $this->set('environmentMission', $environmentMission);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $environmentMission = $this->EnvironmentMissions->newEntity();
        if ($this->request->is('post')) {
            $environmentMission = $this->EnvironmentMissions->patchEntity($environmentMission, $this->request->getData());
            if ($this->EnvironmentMissions->save($environmentMission)) {
                $this->Flash->success(__('The environment mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The environment mission could not be saved. Please, try again.'));
        }
        $this->set(compact('environmentMission'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Environment Mission id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $environmentMission = $this->EnvironmentMissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $environmentMission = $this->EnvironmentMissions->patchEntity($environmentMission, $this->request->getData());
            if ($this->EnvironmentMissions->save($environmentMission)) {
                $this->Flash->success(__('The environment mission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The environment mission could not be saved. Please, try again.'));
        }
        $this->set(compact('environmentMission'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Environment Mission id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $environmentMission = $this->EnvironmentMissions->get($id);
        if ($this->EnvironmentMissions->delete($environmentMission)) {
            $this->Flash->success(__('The environment mission has been deleted.'));
        } else {
            $this->Flash->error(__('The environment mission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
