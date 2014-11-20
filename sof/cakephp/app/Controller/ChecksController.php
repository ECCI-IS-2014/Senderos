<?php

App::uses('AppController', 'Controller');

class ChecksController extends AppController
{
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */
	var $uses = array('Product','Check','CheckProduct','CardUser','User', 'Debitcard', 'DebitcardsUser');
	public function check(){
	
		$idUser = $this->Session->read("Auth.User.id");
        // Extraer numeros de tarjetas tarjetas y pasarlas
        // Debitcard->                Debitcard.card_number              'CardUser.card_id =' => 'Debitcard.id'
        $this->set('debitcards', $this->CardUser->find('list', array(
                        'fields' => array('CardUser.card_id'),
                        'conditions' => array('CardUser.user_id =' => $idUser)
                   ))
        );
		
        $cart = array();

        if ($this->Session->check('Cart')) {
            $cart = $this->Session->read('Cart');
        }

        $this->set(compact('cart'));

        }
	
	public function receipt(){
        // Guardar factura: IDCHECK, idDebit, total,GENERAL_DISCOUNT,DATE
		$total = $this->request->data['Check']['amount'];
		$debCard = $this->request->data['Check']['debcard'];
        $this->set('finalPrice',$total);
		
		// Encuentra la tarjeta
        $debCard = $this->CardUser->find('first',array('conditions'=>array('CardUser.id'=>$debCard)));
        $debCard = $debCard['CardUser']['card_id'];

        // Descuenta de la tarjeta
		$transaction = $this->Debitcard->find('first',array('conditions'=>array('Debitcard.id'=>$debCard)));
		if(($transaction['Debitcard']['balance'] - $total >= 0) && ($transaction['Debitcard']['expiration_date']>date("Y-m-d"))){
			$this->Debitcard->id = $debCard;
			$this->Debitcard->set(array('balance' => $transaction['Debitcard']['balance'] - $total));
			$this->Debitcard->save();
			
			// Aquí se guarda la factura, trayendo los datos del formulario
			$checkId=0;
			if ($this->request->is('post')) {
				// Genera la factura
				$this->Check->create();
				if ($this->Check->save($this->request->data)) {
					$id = $this->request->data['Check']['id'];
					$this->Check->read(null, $id);
					$this->Check->set(['debitcard_id'=>$debCard, 'amount'=>$total, 'general_discount'=> 0, 'sold_the'=>date("Y-m-d H:i:s")]);
					$this->Check->save();
					$checkId = $this->Check->id;
				}
				
				// Muestra el valor de factura
				$this->set('idCheck',$checkId);
				
				$cart = array();
				if ($this->Session->check('Cart')) {
					$cart = $this->Session->read('Cart');
				}
				$this->set(compact('cart'));
				$number = 0;
				foreach($cart as $key => $product ){
					$discount = $product['Product']['discount'];
					$price = $product['Product']['price'];
					$qty = $this->Session->read('CartQty.'.$number);
					// Guardar items de factura: ID,IDCHECK,IDPRODUCT,DISCOUNT,PRICE,QTY
					$this->CheckProduct->create();
					if($this->CheckProduct->save($this->request->data)){
						$id=$this->request->data['CheckProduct']['id'];
						$this->CheckProduct->read(null,$id);
						$this->CheckProduct->set(['check_id'=>$checkId,'product_id'=>$product['Product']['id'],'discount'=>$discount,'prize'=>$price,'quantity'=>$qty]);
						$this->CheckProduct->save();
					}
					$number++;
				}
				$this->Session->delete('Cart');
				$this->Session->delete('CartQty');
				$this->Session->delete('CartPrc');
			}
		
		}

	}

    public function index(){
        // Obtiene el id de usuario
        $idUser = $this->Session->read("Auth.User.id");
        // Obtiene todas las tarjetas a nombre de este usuario
        $debCard=array();
        $debCard= $this->CardUser->find('all',array('conditions'=>array('user.id'=>$idUser)));

        // Aqui deberian obtenerse todas las facturas hechas con esas tarjetas (codigo aun no funciona)
        $checks = array();
        $checks = $this->Check->find('all',array('conditions'=>array('Check.debitcard_id'=>$debCard)));

        // Aqui deberian obtenerse todos los productos pertenecientes a esas facturas (codigo que aun no funciona)
        $checksProducts = $this->CheckProduct->find('all',array('conditions'=>array('CheckProduct.check_id'=>$checks)));

    }

}

?>