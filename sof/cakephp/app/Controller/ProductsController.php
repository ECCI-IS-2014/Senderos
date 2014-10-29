<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');

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
		
		$user =  $this->Session->read("Auth.User.id");
        $wish = $this->Wishlist->field('id', array('user_id ' => $user));

        if($this->ProductWishlist->field('id',array('wishlist_id'=>$wish,'product_id'=>$id)) != null){
            $this->set('in_list','1');
        }
        else{
            $this->set('in_list','0');
        }

    }

	public function edit($id = null) {
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
                    'Product.genre LIKE' => '%'.$con.'%',
                    'Product.description LIKE' => '%'.$con.'%',
                    'Product.console LIKE' => '%'.$con.'%'
                )

            )
        )));
    }

    public function agregarCarrito($id){

        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }else{
            $productsInCart = $this->Session->read('Cart');
            $number = 0;
            $alreadyIn = false;
            foreach ($productsInCart as $productInCart) {
                if ($productInCart['Product']['id'] == $id) {
                    $alreadyIn = true;
                    // aumentar cantidad del objeto actual
                    $this->Session->write('CartQty.'.$number , $this->Session->read('CartQty.'.$number) + 1 );
                    /* CHEQUEAR SI HAY EN STOCK*/
                }
                $number++;
            }
            if(!$alreadyIn){
                // agregar al carrito
                $this->Session->write('Cart.' . $number, $this->Product->read(null, $id));
                $this->Session->write('CartQty.'. $number,1);
                //$this->Session->write('CartPrc.'.$number,);
                /* CHEQUEAR SI HAY EN STOCK*/
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function carrito(){
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));
    }

    public function eliminarCarrito($id){
        if (is_null($id)) {
            throw new NotFoundException(__('Invalid request'));
        }
        if ($this->Session->delete('Cart.' . $id)) {
            $cart = $this->Session->read('Cart');
            sort($cart);
            $this->Session->write('Cart', $cart);

            $this->Session->delete('CartQty.'.$id);
            $cartqty = $this->Session->read('CartQty');
            sort($cartqty);
            $this->Session->write('CartQty',$cartqty);

        }
        return $this->redirect(array('action' => 'carrito'));
    }

    public function vaciar(){
        $this->Session->delete('Cart');
        $this->Session->delete('CartQty');
        return $this->redirect(array('action'=>'index'));
    }

}

?>