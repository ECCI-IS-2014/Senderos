<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class CategoryController extends AppController
{
    public $helpers = array('Html', 'Form');
    var $components = array('Session');

    public function index()
    {
        $this->set('categories',$this->Category->generateTreeList(
            null,
            null,
            null,
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
        ));
    }

    public function add() {
        $this->set('categories',$this->Category->generateTreeList(
            null,
            null,
            null,
            '____'
        ));
        if ($this->request->is('post'))
        {
            $this->Category->create();
            if ($this->Category->save($this->request->data))
            {
                $this->Session->setFlash(__('Esta categoría ha sido guardada.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido guardar esta categoría.'));
        }
    }
}
