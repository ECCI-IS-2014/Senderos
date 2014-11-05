<?php 
class CategoryControllerTest extends ControllerTestCase {
    public $fixtures = array('app.category');

    public function testIndex() {
        $result = $this->testAction('/category/index');
        debug($result);
    }
	public function testAdd() {
        $result = $this->testAction('/products/add');
        debug($result);
    }
	
	public function testAddGetRenderedHtml() {
        $result = $this->testAction(
           '/category/add',
            array('return' => 'contents')
        );
        debug($result);
    }
	
	public function testAddGetViewVars() {
        $result = $this->testAction(
            '/category/add',
            array('return' => 'vars')
        );
        debug($result);
    }
	
	 public function testIndexPostData() {
        $data = array(
            'Category' => array(
                'id' => 1,
                'name' => 'AVENTURA',
                'parent_id' => NULL,
                'lft' => 1,
                'rght' => 2
            )
        );
        $result = $this->testAction(
            '/category/index',
            array('data' => $data, 'method' => 'post')
        );
        debug($result);
    }
}

?>