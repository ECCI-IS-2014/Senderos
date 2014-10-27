<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 19/10/14
 * Time: 01:16 PM
 */
App::uses('AppController', 'Controller');
class CategoryController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('Session');
    public function index(){
        $this->set('categories', $this->Category->find('all'));
    }
    public function add() {
        //tengo que modificar que no me traiga la categoría actual y que me permita la opción de sin categoría
        $this->set('categories', $this->Category->find('list'));
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Esta categoría ha sido guardada.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('No se ha podido guardar esta categoría.'));
        }
    }
}
