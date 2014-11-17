<?php

class DebitcardsUser extends AppModel{

    var $validate = array(
        'user_id' => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada'),
        'debitcard_id'  => array('rule' => 'uniqueCombi', 'message' => 'Combinación ya registrada')
    );
    function uniqueCombi()
    {
        $combi = array(
            "{$this->alias}.user_id" => $this->data[$this->alias]['user_id'],
            "{$this->alias}.debitcard_id"  => $this->data[$this->alias]['debitcard_id']
        );
        return $this->isUnique($combi, false);
    }

    public function bringAllRegisters() {
        return $this->find('all');
    }


    public function removeRegister() {
        $this->delete(1);
        return $this->bringAllRegisters();
    }
}