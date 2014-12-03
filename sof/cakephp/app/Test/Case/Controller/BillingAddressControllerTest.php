<?php 
class BillingAddressControllerTest extends ControllerTestCase {
    public $fixtures = array('app.billingaddress');

    public function testIndex() {
        $result = $this->testAction('/BillingAddress/index');
        debug($result);
    }

	public function testAdd()
    {
        $result = $this->testAction('/BillingAddress/add');
        debug($result);
    }

    public function testDelete()
    {
        $data = $this->testAction('/BillingAddress/delete/1');
        debug($data);
    }

    public function testEdit() {
        $data = $this->testAction('/BillingAddress/edit/1');
        debug($data);
    }
	
	public function testAddGetRenderedHtml() {
        $result = $this->testAction(
           '/BillingAddress/add',
            array('return' => 'contents')
        );
        debug($result);
    }
	
	public function testAddGetViewVars() {
        $result = $this->testAction(
            '/BillingAddress/add',
            array('return' => 'vars')
        );
        debug($result);
    }
	
	 public function testIndexPostData() {
        $data = array(
            'BillingAddress' => array(
                'id' => 1,
                'country' => 1,
                'address' => 'ACÁ'
            )
        );

         $result = $this->testAction(
            '/BillingAddress/index',
            array('data' => $data, 'method' => 'post')
        );
        debug($result);
    }
}
?>