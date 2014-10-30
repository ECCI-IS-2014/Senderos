<?php

App::uses('AppController', 'Controller');

class ProductWishlistController extends AppController{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('ProductWishlist', 'Product', 'Wishlist');

	
	public function index() {
        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        $options['joins'] = array(
            array('table' => 'product_wishlists',
                'alias' => 'ProductWishlist',
                'type' => 'left',
                'conditions' => array(
                    'ProductWishlist.wishlist_id' => $wish,
                    'ProductWishlist.product_id' => 'Product.id'
                )
            )
        );

        $consult = $this->Product->find('all',$options);

        $this->set('ProductWishlistList',$consult);
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
	
	public function delete($product_id = null){
        $user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        $this->ProductWishlist->deleteAll(array('wishlist_id'=>$wish,'product_id'=>$product_id));
        return $this->redirect(array('action' => 'index'));
    }
}

?>