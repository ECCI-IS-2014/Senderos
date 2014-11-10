<?php

App::uses('AppController', 'Controller');

class ChecksController extends AppController
{
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */
	
	public function check(){
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));
    }

}

?>