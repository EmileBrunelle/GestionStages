<?php
namespace App\Controller;

use App\Controller\AppController;

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
                $id = $this->request->getParam('pass.0');
                if (!$id) {
                    return false;
                }
                $employer = $this->Internships->InternshipEnvironments->Employers->findById($id)->first();
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
                $employer = $this->Internships->InternshipEnvironments->Employers->findById($id)->first();
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
            'contain' => ['InternshipEnvironments']
        ];
        $internships = $this->paginate($this->Internships);

        $this->set(compact('internships'));
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
            'contain' => ['InternshipEnvironments']
        ]);

        $this->set('internship', $internship);
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The internship could not be saved. Please, try again.'));
        }
        $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list', ['limit' => 200]);
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
        $internshipEnvironments = $this->Internships->InternshipEnvironments->find('list', ['limit' => 200]);
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
}
