<?php
class CategoryFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      //public $useDbConfig = 'test';
	  public $import = 'Category';
	  //public $import = array('model' => 'Product'); //, 'records' => true);
	  public $records = array(
        array(
			  'id' => 1,
			  'name' => 'AVENTURA',
			  'parent_id' => NULL,
			  'lft' => 1,
			  'rght' => 2
		),
		array(
			  'id' => 2,
			  'name' => 'SUB-AVENTURA',
			  'parent_id' => 1,
			  'lft' => 2,
			  'rght' => 3
		),
		array(
			  'id' => 3,
			  'name' => 'HORROR',
			  'parent_id' => NULL,
			  'lft' => 5,
			  'rght' => 6
		)
    );
 }
 ?>