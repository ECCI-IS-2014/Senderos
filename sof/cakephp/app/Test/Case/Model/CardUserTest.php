<?php
App::uses('CardUser', 'Model');

class CardUserTest extends CakeTestCase {
    public $fixtures = array('app.carduser');

    public function setUp() {
        parent::setUp();
        $this->CardUser = ClassRegistry::init('CardUser');
    }

    public function testBringAllRegisters() {
        $result = $this->CardUser->bringAllRegisters();
        $expected = array(
            array('CardUser' =>  array(
                'id' => 1,
                'user_id' => 1,
                'card_id' =>1,
                'card_type' =>1
            )
            ),
            array('CardUser' =>  array(
                'id' => 2,
                'user_id' => 1,
                'card_id' =>100,
                'card_type' =>2
            )
            )
        );
        $this->assertEquals($expected, $result);
    }

    public function testRemoveRegister() {
        $result = $this->CardUser->removeRegister();
        $expected = array(
            array('CardUser' => array(
                'id' => 2,
                'user_id' => 1,
                'card_id' =>100,
                'card_type' =>2
            )
            )
            );
        $this->assertEquals($expected, $result);
    }
}
?>