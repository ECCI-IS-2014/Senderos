<?php

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');

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