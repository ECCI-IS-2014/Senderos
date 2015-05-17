<?php
class ClientsController extends AppController {
	var $name = 'Clients';
    var $components = array('Auth');

	function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	function add(){
        if (!empty($this->data)){
            if (true) {//$this->data['Client']['password'] == $this->Auth->password($this->data['Client']['password_confirm']))
                $this->Client->create();
                if ($this->Client->save($this->data)){
                        $this->Restriction->create();
                        $this->Restriction->set( array('client_id'=> $this->Client->id,
                                'model' => $this->data['Client']['model0'],
                                'recordid' => $this->data['Client']['recordid0'],
                                'creating' => $this->data['Client']['creating0'],
                                'reading' => $this->data['Client']['reading0'],
                                'updating' => $this->data['Client']['updating0'],
                                'deleting' =>  $this->data['Client']['deleting0'])
                        );
                        $this->Restriction->save();

                        $this->Restriction->create();
                        $this->Restriction->set( array('client_id'=> $this->Client->id,
                                'model' => $this->data['Client']['model1'],
                                'recordid' => $this->data['Client']['recordid1'],
                                'creating' => $this->data['Client']['creating1'],
                                'reading' => $this->data['Client']['reading1'],
                                'updating' => $this->data['Client']['updating1'],
                                'deleting' =>  $this->data['Client']['deleting1'])
                        );
                        $this->Restriction->save();

                        $this->Restriction->create();
                        $this->Restriction->set( array('client_id'=> $this->Client->id,
                                'model' => $this->data['Client']['model2'],
                                'recordid' => $this->data['Client']['recordid2'],
                                'creating' => $this->data['Client']['creating2'],
                                'reading' => $this->data['Client']['reading2'],
                                'updating' => $this->data['Client']['updating2'],
                                'deleting' =>  $this->data['Client']['deleting2'])
                        );
                        $this->Restriction->save();

                        $this->Restriction->create();
                        $this->Restriction->set( array('client_id'=> $this->Client->id,
                                'model' => $this->data['Client']['model3'],
                                'recordid' => $this->data['Client']['recordid3'],
                                'creating' => $this->data['Client']['creating3'],
                                'reading' => $this->data['Client']['reading3'],
                                'updating' => $this->data['Client']['updating3'],
                                'deleting' =>  $this->data['Client']['deleting3'])
                        );
                        $this->Restriction->save();

                    $this->Session->setFlash(__('The client has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
                }
            }
            else{
                $this->Session->setFlash(__('Passwords do not match', true));
            }
        }
        $countries = $this->Client->Country->find('list', array('fields' => array('Country.name')));
        $this->set(compact('countries'));
        $this->set('models', array('Station', 'Trail', 'Point', 'Document'));
    }
	
	/*
	function add() {
        if (!empty($this->data)) {
			$this->Client->create();
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('The client has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->Client->Country->find('list', array('fields' => array('Country.name')));
		$this->set(compact('countries'));
	}*/

	function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid client', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            debug($this->data);
            if ($this->Client->save($this->data)) {
                $this->Restriction->read(null, $this->data['Client']['id0']);
                $this->Restriction->set( array('client_id'=> $this->Client->id,
                        'model' => $this->data['Client']['model0'],
                        'recordid' => $this->data['Client']['recordid0'],
                        'creating' => $this->data['Client']['creating0'],
                        'reading' => $this->data['Client']['reading0'],
                        'updating' => $this->data['Client']['updating0'],
                        'deleting' =>  $this->data['Client']['deleting0'])
                );
                $this->Restriction->save();

                $this->Restriction->read(null, $this->data['Client']['id1']);
                $this->Restriction->set( array('client_id'=> $this->Client->id,
                        'model' => $this->data['Client']['model1'],
                        'recordid' => $this->data['Client']['recordid1'],
                        'creating' => $this->data['Client']['creating1'],
                        'reading' => $this->data['Client']['reading1'],
                        'updating' => $this->data['Client']['updating1'],
                        'deleting' =>  $this->data['Client']['deleting1'])
                );
                $this->Restriction->save();

                $this->Restriction->read(null, $this->data['Client']['id2']);
                $this->Restriction->set( array('client_id'=> $this->Client->id,
                        'model' => $this->data['Client']['model2'],
                        'recordid' => $this->data['Client']['recordid2'],
                        'creating' => $this->data['Client']['creating2'],
                        'reading' => $this->data['Client']['reading2'],
                        'updating' => $this->data['Client']['updating2'],
                        'deleting' =>  $this->data['Client']['deleting2'])
                );
                $this->Restriction->save();

                $this->Restriction->read(null, $this->data['Client']['id3']);
                $this->Restriction->set( array('client_id'=> $this->Client->id,
                        'model' => $this->data['Client']['model3'],
                        'recordid' => $this->data['Client']['recordid3'],
                        'creating' => $this->data['Client']['creating3'],
                        'reading' => $this->data['Client']['reading3'],
                        'updating' => $this->data['Client']['updating3'],
                        'deleting' =>  $this->data['Client']['deleting3'])
                );
                $this->Restriction->save();
                $this->Session->setFlash(__('The client has been saved', true));
                return $this->redirect(array('action' => 'view', $this->Client->id));
            } else {
                $this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Client->read(null, $id);
        }
        $countries = $this->Client->Country->find('list');
        $this->set(compact('countries'));
        //$this->set('models', array('Station', 'Trail', 'Point', 'Document'));
        $this->set('restrictions', $this->Restriction->find('all', array('order' => array('Restriction.model ASC'), 'conditions' => array('Restriction.client_id' => $this->Client->id))));
    }
	
	/*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid client', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash(__('The client has been saved', true));
                return $this->redirect(array('action' => 'view', $this->Client->id));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Client->read(null, $id);
		}
		$countries = $this->Client->Country->find('list');
		$this->set(compact('countries'));
	}*/

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for client', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Client->delete($id)) {
			$this->Session->setFlash(__('Client deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Client was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

    function change($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid client', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Client->saveField('password', AuthComponent::password($this->request->data['Client']['new_password']))) {
                $this->Session->setFlash(__('The client has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client could not be saved. Please, try again please.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Client->read(null, $id);
        }
    }

    /**
     *  El AuthComponent proporciona la funcionalidad necesaria
     *  para el acceso (login), por lo que se puede dejar esta función en blanco.
     */
    function login() {
    }

    function logout() {
        $this->redirect($this->Auth->logout());

    }

    /**
     *
     */
    function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
    }
}
