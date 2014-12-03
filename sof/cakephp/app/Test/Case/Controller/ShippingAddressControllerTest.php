<?php
class ShippingAddressControllerTest extends ControllerTestCase
{
    public $fixtures = array('app.shippingaddress');

    public function testAdd()
    {
        $result = $this->testAction('/shippingaddress/add');
        debug($result);
    }

    public function testEdit()
    {
        $result = $this->testAction('/shippingaddress/edit/1');
        debug($result);
    }

    public function testDelete()
    {
        $result = $this->testAction('/shippingaddress/delete/1');
        debug($result);
    }
}
?>