<?php

App::uses('AppController', 'Controller');

class ProductWishlistController extends AppController{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('ProductWishlist', 'Product', 'Wishlist');

	public function index() {
        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        $products = $this->ProductWishlist->field('product_id',array('wishlist_id' =>$wish));

        $this->set(
             'ProductWishlistList',
             $this->Product->find('all',array('conditions' =>  array ('Product.id' =>$products)))
        );
    }

    public function add($product_id = null){

        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

       $this->ProductWishlist->set(array(
            'wishlist_id' => $wish,
            'product_id' => $product_id
        ));
        $this->ProductWishlist->save();

      return $this->redirect(array('action' => 'index'));
    }
}

?>