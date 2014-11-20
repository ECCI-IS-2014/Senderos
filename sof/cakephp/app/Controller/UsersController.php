<?php

App::uses('AppController', 'Controller');
App::uses('DebitcardController', 'CreditcardController','Controller');

class UsersController extends AppController {

    var $uses = array('Country', 'User', 'Debitcard', 'Creditcard', 'CardUser');

    public function index(){
        $this->set('users',$this->User->find('all'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('users', $this->User->read(null, $id));
        $user = $this->User->findById($id);
        $coun = $this->Country->findById($user['User']['country']);
        $this->set('country', $coun['Country']['country_name']);
		
		$idUser = $this->Session->read("Auth.User.id");
        
		$card = $this->CardUser->find('list', array(
            'fields' => array('CardUser.card_id'),
            'conditions' => array('CardUser.user_id =' => $idUser)));

        /*$c_type = $this->CardUser->find('list', array(
            'fields' => array('CardUser.card_type'),
            'conditions' => array('CardUser.user_id =' => $idUser)));*/

        $this->set('dcard_num', $this->Debitcard->find('list', array(
                'fields' => array('Debitcard.card_number'),
                'conditions' => array('Debitcard.id =' => $card)))
        );

        $this->set('ccard_num', $this->Creditcard->find('list', array(
                'fields' => array('Creditcard.card_number'),
                'conditions' => array('Creditcard.id =' => $card)))
        );
    }

    public function add() {
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {

                $this->request->data['Wishlist']['user_id'] = $this->User->id;
                $this->User->Wishlist->save($this->request->data);
				
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'first_login'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }

    public function edit($id = null) {
        $this->set('countries', $this->Country->find('list', array('fields' => array('Country.country_name'))));
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The changes have been saved'));
				return $this->redirect(array('action' => 'view', $this->User->id));
			}
			$this->Session->setFlash(__('The changes could not be saved. Please, try again.'));
        }
		else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
        }
		
		$idUser = $this->Session->read("Auth.User.id");

        $card = $this->CardUser->find('list', array(
            'fields' => array('CardUser.card_id'),
            'conditions' => array('CardUser.user_id =' => $idUser)));

        /*$c_type = $this->CardUser->find('list', array(
            'fields' => array('CardUser.card_type'),
            'conditions' => array('CardUser.user_id =' => $idUser)));*/

        $this->set('dcard_num', $this->Debitcard->find('list', array(
                'fields' => array('Debitcard.card_number'),
                'conditions' => array('Debitcard.id =' => $card)))
        );

        $this->set('ccard_num', $this->Creditcard->find('list', array(
                'fields' => array('Creditcard.card_number'),
                'conditions' => array('Creditcard.id =' => $card)))
        );
    }

    public function delete($id = null) {
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

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout','help', 'first_login');
    }

    public function first_login()
    {
        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                return $this->redirect(array('controller' => 'debitcard', 'action' => 'register'));
            }
            $this->Session->setFlash(__('Usuario o contrase�a inv�lidas, intente de nuevo'));
        }
    }

    public function login()
    {
        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
	
	public function wishlist(){
	}
    public  function help(){
    }
}