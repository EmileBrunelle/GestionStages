<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InternshipEnvironments Controller
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable $InternshipEnvironments
 *
 * @method \App\Model\Entity\InternshipEnvironment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InternshipEnvironmentsController extends AppController
{

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
            'contain' => ['Employers']
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
        $internshipEnvironment = $this->InternshipEnvironments->newEntity();
        if ($this->request->is('post')) {
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
