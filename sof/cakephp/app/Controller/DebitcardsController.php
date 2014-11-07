<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class DebitcardsController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    var $uses = array('User', 'Debitcard', 'DebitcardsUser');

    public function index()
    {
        //$this->set('data',$this->Category->generateTreeList('all', null, null, ' '));
        $this->set('data', $this->Debitcard->find('all'));
    }

    public function add($userId)
    {
        //$this->set('data',$this->Category->generateTreeList('all', null, null, ' '));
        $this->set('data', $this->Debitcard->find('all'));
        $this->Debitcard->create();
        $this->Debitcard->save(['card_number'=>1,
                                'nip'=>1,
                                'csc'=>1,
                                'expiration_date'=> '2015-01-01',
                                'balance'=>1
                               ]);
        $this->Debitcard->DebitcardsUser->saveAll(['user_id'=>$userId, 'debitcard_id'=>$this->Debitcard->id]);
    }

}