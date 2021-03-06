<?php
class SessionsController extends AppController {

    public $uses = null;

    var $name = 'Sessions';

    function beforeFilter()
    {
        parent::BeforeFilter();
        $this->Auth->allow('display','setsession');
    }

    function setsession()
    {
        $this->autoRender = false; // No renderiza mediate el fichero .ctp

        $var = ''.$_GET['var'].'';
        $value = ''.$_GET['value'].'';

        if(is_numeric($value))
        {
            $_SESSION['client_id'] = ''.$value.'';

            $this->loadModel('Client');
            $client = $this->Client->read(null, $value);
            $role = $client['Client']['role'];
            $value = ''.$role.'';
        }
        else
        {
            $_SESSION['client_id'] = '-1';
        }

        $_SESSION[$var] = $value;
        
        
        //para lo del filtro del menu de la derecha
        if($var === 'role')
    	{
    		$this->loadModel('Visitor');
    		$visitor =  $this->Visitor->findAllByRole($_SESSION['role']);
    		$_SESSION['client_id'] = $visitor[0]['Visitor']['id'];
    
    	}
	
	    //fin para lo del filtro ....
        
        
    }
}
