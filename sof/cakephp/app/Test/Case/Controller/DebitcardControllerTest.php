<?php
class DebitcardControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.debitcard');

    public function testIndex()
    {
        $result = $this->testAction('/debitcard/index');
        debug($result);
    }

    public function testAdd()
    {
        $result = $this->testAction('/debitcard/add');
        debug($result);
    }

    public function testRegister()
    {
        $result = $this->testAction('/debitcard/register');
        debug($result);
    }
}
?>