<?php

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	
	/*The $validate array tells CakePHP how to validate your data when the save() method is called.*/
	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'genre' => array(
            'rule' => 'notEmpty'
        ),
		'console' => array(
            'rule' => 'notEmpty'
        ),
		'release_year' => array(
            'rule' => 'notEmpty'
        ),
		'price' => array(
            'rule' => 'notEmpty'
        ),
		'description' => array(
            'rule' => 'notEmpty'
        )
    );

    public function index()
    {
        $this->set('products', $this->Product->find('all'));
    }

    public function view($id = null)
    {
        if(!$id)
        {
            throw new NotFoundException(__('Invalid product'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->set('product', $product);
    }

	public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('product', 'put'))) {
            $this->Product->id = $id;
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $product;
        }
    }
	
	public function add() {
		/*$this->request->is() takes a single argument, which can be the request METHOD (get, put, post, delete) 
		or some request identifier (ajax). It is not a way to check for specific posted data. For instance, 
		$this->request->is('book')will not return true if book data was posted.*/
        if ($this->request->is('post')) { 
			/*We call the create() method first in order to reset the model state for saving new information. 
			It does not actually create a record in the database, 
			but clears Model::$id and sets Model::$data based on your database field defaults.*/
            $this->Product->create();
			/*if the HTTP method of the request was POST, it tries to save the data using the Post model.*/
			/*When a user uses a form to POST data to your application, that information is available in $this->request->data. 
			You can use the pr() or debug() functions to print it out if you want to see what it looks like.*/
            if ($this->Product->save($this->request->data)) {
				/*We use the SessionComponent’s SessionComponent::setFlash() method to set a message to a session variable to be displayed 
				on the page after redirection. In the layout we have SessionHelper::flash which displays the message and clears the corresponding 
				session variable. The controller’s Controller::redirect function redirects to another URL. The param array('action' => 'index') 
				translates to URL /posts (that is, the index action of the posts controller). You can refer to Router::url() function on the API to see the 
				formats in which you can specify a URL for various CakePHP functions*/
				/*Calling the save() method will check for validation errors and abort the save if any occur.*/
                $this->Session->setFlash(__('Your product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
			/*If for some reason it doesn’t save, it just renders the view. This gives us a chance to show the user validation errors or other warnings*/
            $this->Session->setFlash(__('Unable to add your product.'));
        }
    }
	
    public function delete($id)
    {
        if ($this->request->is('get'))
        {
            throw new MethodNotAllowedException();
        }

        if ($this->Product->delete($id))
        {
            /*$this->Session->setFlash(
                __('The post with id: %s has been deleted.', h($id))
            );*/
            return $this->redirect(array('action' => 'index'));
        }
    }
}

?>