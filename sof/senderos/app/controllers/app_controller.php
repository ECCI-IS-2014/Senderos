<?php

class AppController extends Controller {
	
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'trails',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'trails',
                'action' => 'index',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        ),
	'Cookie'
    );

    function beforeFilter() {
        $this->Auth->userModel = 'Client';
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->allow('display');
    }
}
