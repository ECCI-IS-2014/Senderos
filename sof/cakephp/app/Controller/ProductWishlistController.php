<?php

App::uses('AppController', 'Controller');

class ProductWishlistController extends AppController{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('ProductWishlist', 'Product', 'Wishlist');

	public function index() {
        $this->set(
             'ProductWishlistList',
             $this->ProductWishlist->find('all')
         );
    }

    public function add() {
        $this->set('products', $this->Product->find('list'));
        $this->set('wishlists', $this->Wishlist->find('list'));
        if ($this->request->is('post')) {
			if ($this->ProductWishlist->saveAll($this->request->data, ['validate' => 'first'])) {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
}

?>