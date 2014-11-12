<?php

App::uses('AppController', 'Controller');

class ChecksController extends AppController
{
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */
	var $uses = array('User', 'Debitcard', 'DebitcardsUser');
	public function check(){
	
		$idUser = $this->Session->read("Auth.User.id");
        $this->set('debitcards', $this->Debitcard->DebitcardsUser->find('list', array(
                        'fields' => array('DebitcardsUser.debitcard_id'),
                        'conditions' => array('DebitcardsUser.user_id =' => $idUser)
                   ))
        );
		
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));
    }
	
	public function receipt(){
		$idCheck = 1337;
	}

}

?>