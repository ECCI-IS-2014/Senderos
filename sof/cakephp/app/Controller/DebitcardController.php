<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class DebitcardController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('User', 'Debitcard', 'DebitcardsUser');

    public function index()
    {
        $this->set('data', $this->Debitcard->find('all'));
    }

    public function add()
    {
        $user_id =  $this->Session->read("Auth.User.id");
        $this->set('data', $this->Debitcard->find('all'));
        $this->Debitcard->create();
        $this->Debitcard->save(['card_number'=>1,
                                'nip'=>1,
                                'csc'=>1,
                                'expiration_date'=> '2015-01-01',
                                'balance'=>1
                               ]);
        $this->Debitcard->DebitcardsUser->saveAll(['user_id'=> $user_id, 'debitcard_id'=>$this->Debitcard->id]);
    }

    public function register()
    {
        $user =  $this->Session->read("Auth.User.id");
        if ($this->request->is('post'))
        {
            $cardnumber = $this->request->data['Debitcard']['card_number'];
            $cardcsc = $this->request->data['Debitcard']['csc'];
            $card = $this->Debitcard->findByCardNumber($cardnumber);

            if($cardnumber == $card['Debitcard']['card_number'] && $cardcsc == $card['Debitcard']['csc'])
            {
                $this->Debitcard->DebitcardsUser->saveAll(['user_id'=>$user, 'debitcard_id'=>$card['Debitcard']['id']]);
                $this->Session->setFlash(__('Se ha registrado su tarjeta'));
            }
            else
            {
                $this->Session->setFlash(__('No se ha podido registrado su tarjeta'));
            }
        }
    }

}