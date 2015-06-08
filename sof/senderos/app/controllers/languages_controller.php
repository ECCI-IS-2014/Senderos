<?php
class LanguagesController extends AppController
{
    var $name = 'Languages';

    function beforeFilter()
    {
        parent::BeforeFilter();
        $this->Auth->allow('display','selectlanguage','setlanguage', 'getlanguages','getlanname','getid', 'isavailable');
    }

    function getlanguages()
    {
        return $this->Language->find('all');
    }

    function getlanname()
    {
        return $this->Language->findById($_SESSION['language']);
    }
	
    function selectlanguage() // Define el idioma de la sesi�n para mostrar informaci�n
    {
        $language = ''.$_GET['language'].'';
        $_SESSION['language']= $language;
    }

    function setlanguage() // Define el idioma de las vistas
    {
        $lan = ''.$_GET['lan'].'';
        $_SESSION['lanview']= $lan;
    }

    function index($id = null)
    {
        $this->Language->recursive = 0;
        $this->set('languages', $this->paginate());
    }

    function view($id = null)
    {
        if(!$id)
        {
            $this->Session->setFlash(__('Invalid languages', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('language', $this->Language->read(null, $id));
    }

    function add()
    {
        if(!empty($this->data))
        {
            $this->Language->create();
            if($this->Language->save($this->data))
            {
                $this->Session->setFlash(__('The language has been saved', true));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The language could not be saved. Please, try again.', true));
            }
        }
    }

    function edit($id = null)
    {
        if(!$id && empty($this->data))
        {
            $this->Session->setFlash(__('Invalid language', true));
            $this->redirect(array('action' => 'index'));
        }
        if(!empty($this->data))
        {
            if($this->Language->save($this->data))
            {
                $this->Session->setFlash(__('The language has been saved', true));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The language could not be saved. Please, try again.', true));
            }
        }
        if(empty($this->data))
        {
            $this->data = $this->Language->read(null, $id);
        }
    }

    function delete($id = null)
    {
        if(!$id)
        {
            $this->Session->setFlash(__('Invalid id for language', true));
            $this->redirect(array('action'=>'index'));
        }
        if($this->Language->delete($id))
        {
            $this->Session->setFlash(__('Language deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Language was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

	// mando el code, devuelve el id
	function getid($code)
	{
		$id = null;
		//$languages = $this->Language->findAllByCode($code);
		$languages = $this->Language->findAllById($code);
		foreach($languages as $language):
			$id = $language['Language']['id'];
			break;
		endforeach;
		return $id;
	}

	// pregunta si un lenguaje esta ligado a un documento
	function isavailable($thislanguage, $document_id)
	{
		$this->loadModel('DocumentsLanguage');

		$languages = $this->DocumentsLanguage->findAllByDocumentId($document_id);
		
		foreach($languages as $language):
			if($language['Language']['name'] === $thislanguage)
				return true;
		endforeach;

		return false;
	}
	
	//nada ...
}
