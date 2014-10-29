<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock');

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

	/*public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid product'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid product'));
        }

        if ($this->request->is(array('product', 'put'))) {
            $this->Product->id = $id;
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Your product has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your product.'));
        }

        if (!$this->request->data) {
            $this->request->data = $product;
        }
    }*/
	
	public function edit($id = null) {
        $this->set('platforms', $this->Platform->find('list'));
        $this->set('categories', $this->Category->find('list'));
        if (!$id) {
            throw new NotFoundException(__('Invalid product'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid product'));
        }

        if ($this->request->is(array('product', 'put'))) {
            $this->Product->id = $id;
            if ($this->Product->save($this->request->data)) {
                //$this->Product->Stock->save(['product_id'=>$this->Product->id, 'amount'=>$this->request->data['Product']['amount']]);
                if($this->request->data['Product']['archivo']['error'] == 0 &&  $this->request->data['Product']['archivo']['size'] > 0){
                    // Informacion del tipo de archivo subido $this->data['Product']['archivo']['type']
                    //$destino = WWW_ROOT.'uploads'.DS;
                    $destino = WWW_ROOT.'img'.DS;
                    move_uploaded_file($this->request->data['Product']['archivo']['tmp_name'], $destino.$this->request->data['Product']['archivo']['name']);
                    $id = $this->request->data['Product']['id'];
                    $this->Product->read(null, $id);
                    $this->Product->set('image', $this->request->data['Product']['archivo']['name']);
                    $this->Product->save();

                }
                $this->Session->setFlash(__('El producto se ha actualizado.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se pudo guardar los cambios.'));
        }

        if (!$this->request->data) {
            $this->request->data = $product;
        }
    }
	
	/* public function add() {
        if ($this->request->is('post')) { 
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Your product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your product.'));
        }
    } */
	
	/*public function add() {
        if ($this->request->is('post')) { 
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
				if($this->request->data['Product']['archivo']['error'] == 0 &&  $this->request->data['Product']['archivo']['size'] > 0){
				  // Informacion del tipo de archivo subido $this->data['Product']['archivo']['type']
				  //$destino = WWW_ROOT.'uploads'.DS;
				  $destino = WWW_ROOT.'img'.DS;
				  move_uploaded_file($this->request->data['Product']['archivo']['tmp_name'], $destino.$this->request->data['Product']['archivo']['name']);
				  $id = $this->request->data['Product']['id'];
				  $this->Product->read(null, $id);
				  $this->Product->set('image', $this->request->data['Product']['archivo']['name']);
				  $this->Product->save();
				}
                $this->Session->setFlash(__('Your product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your product.'));
        }
    }*/
	
	//necesito recibir la plataforma, la categoría y la cantidad.
    //meto una entrada en stocks con la cantidad
    //recibo un array con la lista de categorías a las q pertenece el producto y meto por cada entrada en el array, una nueva entrada en categories_products
    //en amount viene la cantidad
    //en category viene el array de categorías
	public function add() {
		$this->set('platforms', $this->Platform->find('list'));
        $this->set('categories', $this->Category->find('list'));
        if ($this->request->is('post')) { 
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Product->Stock->save(['product_id'=>$this->Product->id, 'amount'=>$this->request->data['Product']['amount']]);
				if($this->request->data['Product']['archivo']['error'] == 0 &&  $this->request->data['Product']['archivo']['size'] > 0){
				  // Informacion del tipo de archivo subido $this->data['Product']['archivo']['type']
				  //$destino = WWW_ROOT.'uploads'.DS;
				  $destino = WWW_ROOT.'img'.DS;
				  move_uploaded_file($this->request->data['Product']['archivo']['tmp_name'], $destino.$this->request->data['Product']['archivo']['name']);
				  $id = $this->request->data['Product']['id'];
				  $this->Product->read(null, $id);
				  $this->Product->set('image', $this->request->data['Product']['archivo']['name']);
				  $this->Product->save();

				}
                $this->Session->setFlash(__('Your product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
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
	
	public function removecp($productId, $categoryId){
        if(empty($productId) || empty($categoryId)) return false;

        $this->Product->CategoryProduct->deleteAll(array(
            'product_id' => $productId,
            'CategoryProduct.category_id' => $categoryId
        ));
    }
	
    function search() {
        /*$this->set('results',$this->Post->find('all', array('conditions' => array(
            'Post.title LIKE' => '%q%',
            'Post.body LIKE' => '%q%'))));
        */
        if (isset($this->request->data['Products']['q'])) {
            $con = $this->request->data['Products']['q'];
        } else {
            $con = "";
        }

        $this->set('results',$this->Product->find('all',array(
            'conditions' =>  array (
                'OR' => array(
                    'Product.name LIKE' => '%'.$con.'%',
                    'Product.release_year LIKE' => '%'.$con.'%',
                    'Product.description LIKE' => '%'.$con.'%',
                    'Platform.name LIKE' => '%'.$con.'%',
                )

            )
        )));
    }
}

?>