<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Coordinators Controller
 *
 * @property \App\Model\Table\CoordinatorsTable $Coordinators
 *
 * @method \App\Model\Entity\Coordinator[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoordinatorsController extends AppController
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
        }

        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $coordinator = $this->Coordinators->findById($id)->first();
                return $coordinator->id_user === $user['id'];
            }
        }

        if (in_array($action, ['edit'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            if (isset($user['role']) && $user['role'] === 'coordinator') {
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $coordinator = $this->Coordinators->findById($id)->first();
                return $coordinator->id_user === $user['id'];
            }
        }

        if (in_array($action, ['delete'])) {
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
        $coordinators = $this->paginate($this->Coordinators);

        $this->set(compact('coordinators'));
    }

    /**
     * View method
     *
     * @param string|null $id Coordinator id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coordinator = $this->Coordinators->get($id, [
            'contain' => []
        ]);

        $this->set('coordinator', $coordinator);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coordinator = $this->Coordinators->newEntity();
        if ($this->request->is('post')) {
            $coordinator = $this->Coordinators->patchEntity($coordinator, $this->request->getData());
            if ($this->Coordinators->save($coordinator)) {
                $this->Flash->success(__('The coordinator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coordinator could not be saved. Please, try again.'));
        }
        $this->set(compact('coordinator'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coordinator id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coordinator = $this->Coordinators->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coordinator = $this->Coordinators->patchEntity($coordinator, $this->request->getData());
            if ($this->Coordinators->save($coordinator)) {
                $this->Flash->success(__('The coordinator has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coordinator could not be saved. Please, try again.'));
        }
        $this->set(compact('coordinator'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coordinator id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coordinator = $this->Coordinators->get($id);
        if ($this->Coordinators->delete($coordinator)) {
            $this->Flash->success(__('The coordinator has been deleted.'));
        } else {
            $this->Flash->error(__('The coordinator could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
