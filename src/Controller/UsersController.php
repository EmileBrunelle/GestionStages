<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Student;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout', 'add', 'password', 'sendResetEmail', 'reset']);
    }

    public function isAuthorized($user)
    {
        if ($user['role'])
            $action = $this->request->getParam('action');

        if (in_array($action, ['add', 'password', 'sendResetEmail', 'reset'])) {
            return true;
        }

        if (in_array($action, ['view'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
            $userAuth = $this->Users->findById($id)->first();
            return $userAuth->id === $user['id'];
        }

        if (in_array($action, ['edit'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            }

            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
            $userAuth = $this->Users->findById($id)->first();
            return $userAuth->id === $user['id'];
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));

        $role = $this->Auth->user('role');
        if (isset($role) && ($role === 'admin' || $role === 'coordinator')){
            $this->set('can_view', 1);
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $this->Auth->setUser($user);

                if ($user->get('role') === 'student'){
                    return $this->redirect(['controller' => 'Students', 'action' => 'add']);
                }

                if ($user->get('role') === 'employer'){
                    return $this->redirect(['controller' => 'Employers', 'action' => 'add']);
                }

            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function password() {
        if ($this->request->is('post')) {
            $students = TableRegistry::get('Students')->find();
            $employers = TableRegistry::get('Employers')->find();


            $emailAddress = $this->request->getData('email');

            $usager = null;

            foreach ($students as $student) {
                if ($student['email'] == $emailAddress) {
                    $usager = $student;
                    break;
                }
            }

            foreach ($employers as $employer) {
                if ($employer == $emailAddress) {
                    $usager = $employer;
                }
            }

            if (is_null($usager)) {
                $this->Flash->error('Email address does not exist. Please try again');
            } else {
                $passkey = uniqid();
                $url = Router::Url(['controller' => 'users', 'action' => 'reset'], true) . '/' . $passkey;
                $timeout = time() + DAY;
                if ($this->Users->updateAll(['passkey' => $passkey, 'timeout' => $timeout], ['id' => $usager->id_user])){
                    $this->sendResetEmail($url, $usager);
                    $this->redirect(['action' => 'login']);
                    $this->Flash->success('An Email as been sent');
                } else {
                    $this->Flash->error('Error saving reset passkey/timeout');
                }
            }


        }
    }

    private function sendResetEmail($url, $usager) {
        $email = new Email();
        $emailAddress = $usager['email'];

        $message = 'Visit this link to reset your password: ' . $url;

        if ($emailAddress){
            $email->setTo($emailAddress)->setSubject("Password Reset")->send($message);
        }
    }

    public function reset($passkey = null) {
        if ($passkey) {
            $query = $this->Users->find('all', ['conditions' => ['passkey' => $passkey, 'timeout >' => time()]]);
            $user = $query->first();
            if ($user) {
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $user['passkey'] = null;
                    $user['timeout'] = null;
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
                $this->redirect(['action' => 'password']);
            }
            unset($user->password);
            $this->set(compact('user'));
        } else {
            $this->redirect('/');
        }
    }
}
