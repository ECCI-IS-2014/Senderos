<?php
/**
 * Created by PhpStorm.
 * User: Erick
 * Date: 09/10/14
 * Time: 12:44 AM
 */

class ProductsController extends AppController
{
    public $helpers = array('Html', 'Form');

    public function index()
    {
        $this->set('products', $this->Product->find('all'));
    }
}

?>