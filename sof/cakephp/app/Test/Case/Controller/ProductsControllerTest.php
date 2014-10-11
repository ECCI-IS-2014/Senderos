<?php 
class ProductsControllerTest extends ControllerTestCase {
    //public $fixtures = array('app.product');

    public function testIndex() {
        $result = $this->testAction('/products/index');
        debug($result);
    }

}
?>