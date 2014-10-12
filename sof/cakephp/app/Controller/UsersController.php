<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public function index(){
        $this->set('users',$this->User->find('all'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('users', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The changes have been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The changes could not be saved. Please, try again.'));
        }
		else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
<<<<<<< HEAD
		$this->request->onlyAllow('post');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
    }
=======
    $this->request->onlyAllow('post');

    $this->User->id = $id;
    if (!$this->User->exists()) {
    throw new NotFoundException(__('Invalid user'));
    }
    if ($this->User->delete()) {
    $this->Session->setFlash(__('User deleted'));
    return $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('User was not deleted'));
    return $this->redirect(array('action' => 'index'));
    }
	
	/*
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }*/

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

>>>>>>> 6db5ff2af3355d01b37ef9a5c9684eaf1588bde6
}