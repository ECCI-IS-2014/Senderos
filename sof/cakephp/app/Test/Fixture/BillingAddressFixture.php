<?php
class BillingAddressFixture extends CakeTestFixture {

    public $import = array('model' => 'BillingAddress');
    public $useDbConfig = 'test';

    public $fields = array(
        'id' => array('type' => 'integer', 'key' => 'primary'),
        'country' => array('type' => 'integer'),
        'address' => array('type' => 'string')
    );

    public $records = array(
        array(
            'id' => 1,
            'country' => 52,
            'address' =>'Flores, Heredia'
        )/*,
        array(
            'id' => 2,
            'country' => 52,
            'address' =>'Santo Domingo, Heredia'
        )*/
    );
}
 ?>

