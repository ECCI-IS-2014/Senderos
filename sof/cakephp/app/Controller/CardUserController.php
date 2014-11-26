<?php
App::uses('AppController', 'Controller');

class CardUserController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('CardUser', 'Debitcard', 'Creditcard','User');


    public function index()
    {
        $user =  $this->Session->read("Auth.User.id");

        $this->set('name',$this->User->field('name',array('id'=> $user)));
        $this->set('lastname',$this->User->field('lastname',array('id'=> $user)));

        $this->set('CardUserList',$this->CardUser->find('all'));


    }

    public function delete_debit()
    {
        $user =  $this->Session->read("Auth.User.id");

        if ($this->request->is('post'))
        {
            $card_number = $this->request->data['Debitcard']['card_number'];
            $card = $this->Debitcard->field('id', array('card_number ' => $card_number));
            $this->CardUser->deleteAll(array('user_id'=>$user,'card_id'=>$card));
            return $this->redirect(array('controller' => 'products' ,'action' => 'index'));
        }
    }

    public function delete_credit()
    {
        $user =  $this->Session->read("Auth.User.id");

        if ($this->request->is('post'))
        {
            $card_number = $this->request->data['Creditcard']['card_number'];
            $card = $this->Creditcard->field('id', array('card_number ' => $card_number));
            $this->CardUser->deleteAll(array('user_id'=>$user,'card_id'=>$card));
            return $this->redirect(array('controller' => 'products' ,'action' => 'index'));
        }
    }
}
?>