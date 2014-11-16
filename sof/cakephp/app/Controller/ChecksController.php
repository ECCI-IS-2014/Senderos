<?php

App::uses('AppController', 'Controller');

class ChecksController extends AppController
{
    /*public $helpers = array('Html', 'Form');
	var $components = array('Session');
	var $uses = array('Product', 'Platform', 'Category', 'CategoryProduct', 'Stock','Wishlist','ProductWishlist');
    */
	var $uses = array('Product','Check','CheckProduct','User', 'Debitcard', 'DebitcardsUser');
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
        // Guardar factura: IDCHECK, idDebit, total,GENERAL_DISCOUNT,DATE
		$total = $this->request->data['Check']['amount'];
		$debCard = $this->request->data['Check']['debcard'];
        $this->set('finalPrice',$total);
		
		/*//Aquí van las variables que se pasan al formulario
        $idUser = $this->Session->read("Auth.User.id");
        $this->set('debitcards', $this->Debitcard->DebitcardsUser->find('list', array(
                'fields' => array('DebitcardsUser.debitcard_id'),
                'conditions' => array('DebitcardsUser.user_id =' => $idUser)
         )) );
        $total = 0; //Aquí ves de dónde sacas el valor de total
        $this->set('total', $total);*/
		
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
			
			// Descuenta de la tarjeta
			$transaction = $this->Debitcard->find('first',array('conditions'=>array('Debitcard.id'=>$debCard)));
			$this->Debitcard->id = $debCard;
			$this->Debitcard->set(array('balance' => $transaction['Debitcard']['balance'] - $total));
			$this->Debitcard->save();
			
			$cart = array();
			if ($this->Session->check('Cart')) {
				$cart = $this->Session->read('Cart');
			}
			$this->set(compact('cart'));
			$number = 0;
			foreach($cart as $key => $product ){
				$discount = $product['Product']['discount'];
				$price = $product['Product']['price']*(100-$discount)/100;
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

?>