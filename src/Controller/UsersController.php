<?php

declare(strict_types=1);

namespace App\Controller;


class UsersController extends AppController
{
    private $projectTable;
    // private $adminTable;
    public function initialize(): void
    {
        parent::initialize();
        $this->projectTable = $this->getTableLocator()->get('Projects');
        // $this->adminTable = $this->getTableLocator()->get('Admins');
        // $this->loadModel('Projects');
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }


    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
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


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        // $data = $this->Users->find()->toList();

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $adminLogin = 0;
            $userType = $this->request->getAttribute('identity')['user_type'];

            if ($userType == $adminLogin) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index',
                ]);

                return $this->redirect($redirect);
            } else {
                return $this->redirect(['action' => 'userLogedin']);
            }
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function userLogedin()
    {
        $userId = $this->request->getAttribute('identity')['id'];
        $projectList = $this->projectTable->find()->where(['user_id' => $userId])->toList();

        $userData = $this->Users->get($userId);

        $this->set(compact('projectList', 'userData'));
    }

    // in src/Controller/UsersController.php

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function addProject()
    {
        $userData = $this->Users->find()->toList();

        $project = $this->projectTable->newEmptyEntity();

        if ($this->request->is('post')) {

            $project = $this->projectTable->patchEntity($project, $this->request->getData());
            if ($this->projectTable->save($project)) {
                return $this->redirect(['controller' => 'users', 'action' => 'projectList']);
            }
        }
        $this->set(compact('userData', 'project'));
    }

    public function projectList()
    {
        $projectList = $this->projectTable->find();
        $projectData = $projectList->select([
            'projects.id',
            'projects.project_name',
            'projects.project_cost',
            'u.name'
        ])->join([
            'table' => 'users',
            'alias' => 'u',
            'type' => 'inner',
            'conditions' => 'projects.user_id = u.id'
        ])->toList();

        $this->set(compact('projectData'));
    }
}
