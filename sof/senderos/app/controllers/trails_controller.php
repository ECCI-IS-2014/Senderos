<?php
class TrailsController extends AppController {

	var $name = 'Trails';
    var $uses = array('Trail', 'Restriction');

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Trail.station_id' => 'asc'
        )
    );



    function beforeFilter() {
		parent::BeforeFilter();
        $this->Auth->allow('view', 'stationtrails', 'trail', 'display');
    }
	
	function index() {
		$this->Trail->recursive = 0;
		$this->set('trails', $this->paginate());
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}
	
	function stationtrails($id) {
		//$this->Trail->recursive = 0;
		$this->set('trails', $this->Trail->findAllByStationId($id));
	
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}
	
    function trail ($id = null)
    {
        if (!$id) {
            //$this->Session->setFlash(__('Invalid trail', true));
            //$this->redirect(array('action' => 'index'));
        }
        $trail = $this->Trail->findById($id);
        $this->set('trail', $trail);
        $this->loadModel('Station');
        $this->set('stations',$this->Station->find('all'));

        //para lo del filtro del menu de la derecha

        if(isset($_SESSION['language']) && isset($_SESSION['client_id']))
        {
			  $myquery=$this->Trail->query('SELECT Trail.name, Trail.station_id FROM trails Trail WHERE Trail.id IN (SELECT Point.trail_id FROM points Point WHERE Point.id IN (SELECT DocumentsPoint.point_id FROM documents_points DocumentsPoint WHERE DocumentsPoint.document_id IN (SELECT DocumentsLanguage.document_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.language_id = '.$_SESSION['language'].') AND DocumentsPoint.document_id IN (SELECT DocumentsVisitor.document_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.visitor_id = '.$_SESSION['client_id'].')))');
			  $this->set('myquery',$myquery);

			  $myquery=$this->Trail->query('SELECT DISTINCT Language.name FROM languages Language WHERE Language.id IN (SELECT DocumentsLanguage.language_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.document_id IN (SELECT DocumentsVisitor.document_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.visitor_id = '.$_SESSION['client_id'].'))');
			  $this->set('languagesavailable',$myquery);

			  $myquery=$this->Trail->query('SELECT DISTINCT Visitor.role FROM visitors Visitor WHERE Visitor.id IN (SELECT DocumentsVisitor.visitor_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.document_id IN (SELECT DocumentsLanguage.document_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.language_id = '.$_SESSION['language'].'))');
			  $this->set('visitorsavailable',$myquery);

			  $myquery=$this->Trail->query('SELECT Language.name FROM languages Language WHERE Language.id = '.$_SESSION['language'].'');
			  $this->set('lan_name',$myquery[0]['Language']['name']);

			  $myquery=$this->Trail->query('SELECT Visitor.role FROM visitors Visitor WHERE Visitor.id = '.$_SESSION['client_id'].'');
			  $this->set('vis_role',$myquery[0]['Visitor']['role']);

        }
        else if(isset($_SESSION['language']) && !isset($_SESSION['client_id']))
        {
              $myquery=$this->Trail->query('SELECT Trail.name, Trail.station_id FROM trails Trail WHERE Trail.id IN (SELECT Point.trail_id FROM points Point WHERE Point.id IN (SELECT DocumentsPoint.point_id FROM documents_points DocumentsPoint WHERE DocumentsPoint.document_id IN (SELECT DocumentsLanguage.document_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.language_id = '.$_SESSION['language'].')))');
              $this->set('myquery',$myquery);

			  /*$myquery=$this->Trail->query('select name, station_id from trails where id in (select trail_id from points where id in (select point_id from documents_points where document_id in (select document_id from documents_languages where language_id = '.$_SESSION['language'].')));');
			  $this->set('myquery',$myquery);*/

              $myquery=$this->Trail->query('SELECT DISTINCT Visitor.role FROM visitors Visitor WHERE Visitor.id IN (SELECT DocumentsVisitor.visitor_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.document_id IN (SELECT DocumentsLanguage.document_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.language_id = '.$_SESSION['language'].'))');
              $this->set('visitorsavailable',$myquery);

			  /*$myquery=$this->Trail->query('select distinct(role) from visitors where id in (select visitor_id from documents_visitors where document_id in (select document_id from documents_languages where language_id = '.$_SESSION['language'].'));');
			  $this->set('visitorsavailable',$myquery);*/

              $myquery=$this->Trail->query('SELECT Language.name FROM languages Language WHERE Language.id = '.$_SESSION['language'].'');
              $this->set('lan_name',$myquery[0]['Language']['name']);

			  /*$myquery=$this->Trail->query('select name from languages where id = '.$_SESSION['language'].';');
			  $this->set('lan_name',$myquery[0]['languages']['name']);*/

        }
        else if(!isset($_SESSION['language']) && isset($_SESSION['client_id']))
        {
              $myquery=$this->Trail->query('SELECT Trail.name, Trail.station_id FROM trails Trail WHERE Trail.id IN (SELECT Point.trail_id FROM points Point WHERE Point.id IN (SELECT DocumentsPoint.point_id FROM documents_points DocumentsPoint WHERE DocumentsPoint.document_id IN (SELECT DocumentsVisitor.document_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.visitor_id = '.$_SESSION['client_id'].')))');
              $this->set('myquery',$myquery);

			  /*$myquery=$this->Trail->query('select name, station_id from trails where id in (select trail_id from points where id in (select point_id from documents_points where document_id in (select document_id from documents_visitors where visitor_id = '.$_SESSION['client_id'].')));');
			  $this->set('myquery',$myquery);*/

              $myquery=$this->Trail->query('SELECT DISTINCT Language.name FROM languages Language WHERE Language.id IN (SELECT DocumentsLanguage.language_id FROM documents_languages DocumentsLanguage WHERE DocumentsLanguage.document_id IN (SELECT DocumentsVisitor.document_id FROM documents_visitors DocumentsVisitor WHERE DocumentsVisitor.visitor_id = '.$_SESSION['client_id'].'))');
              $this->set('languagesavailable',$myquery);

			  /*$myquery=$this->Trail->query('select distinct(name) from languages where id in (select language_id from documents_languages where document_id in (select document_id from documents_visitors where visitor_id = '.$_SESSION['client_id'].'));');
			  $this->set('languagesavailable',$myquery);*/

              $myquery=$this->Trail->query('SELECT Visitor.role FROM visitors Visitor WHERE Visitor.id = '.$_SESSION['client_id'].'');
              $this->set('vis_role',$myquery[0]['Visitor']['role']);

			  /*$myquery=$this->Trail->query('select role from visitors where id = '.$_SESSION['client_id'].';');
			  $this->set('vis_role',$myquery[0]['visitors']['role']);*/
	    }
	    //fin para lo del filtro ....


        if($_SESSION['role'] === 'restricted')
        {
            $this->loadModel('Restriction');
            $this->set('restrictions', $this->Restriction->findAllByClientId($_SESSION['client_id']));

        }
    }

    function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid trail', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->set('trail', $this->Trail->read(null, $id));
		$trail = $this->Trail->findById($id);
        		//$trail = $this->Trail->findById($id, array('contain' => false));
		$this->set('trail', $trail);
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
        $this->set('station',$this->Trail->field('station_id',array('Trail.id'=>$id)));
		//$this->set('points', $this->Trail->findById($id)->Point->find('all'));
	}



	function add() {
		if (!empty($this->data)) {
			$this->Trail->create();
			if ($this->Trail->save($this->data)) {
				//if($this->request->data['Trail']['archivo']['error'] == 0 &&  $this->request->data['Trail']['archivo']['size'] > 0){
                //debug($this->data);
                //debug($this->data['Trail']);
                if($this->data['Trail']['archivo']['error'] == 0 &&  $this->data['Trail']['archivo']['size'] > 0){
                    //echo('helo');
					// Informacion del tipo de archivo subido $this->data['Trail']['archivo']['type']
					//$destino = WWW_ROOT.'uploads'.DS;
					$destino = WWW_ROOT.'img'.DS;
					move_uploaded_file($this->data['Trail']['archivo']['tmp_name'], $destino.$this->data['Trail']['archivo']['name']);
					$id = $this->data['Trail']['id'];
					$this->Trail->read(null, $id);
					$this->Trail->set('image', $this->data['Trail']['archivo']['name']);
					$this->Trail->save();
				}
				$this->Session->setFlash(__('The trail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trail could not be saved. Please, try again.', true));
			}
		}
        $this->loadModel('Restriction');
        $all = $this->Restriction->field('allt',array('client_id'=>$this->Session->read("Auth.Client.id")));
        if($_SESSION['role'] === 'restricted' && $all == 1){
            $stat = $this->Restriction->field('station_id',array('client_id'=>$this->Session->read("Auth.Client.id")));
            $stations = $this->Trail->Station->find('list',array('conditions'=>array(
                'Station.id'=> $stat
            )));
        }else {
            $stations = $this->Trail->Station->find('list');
        }
		$this->set(compact('stations'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
		
        if($_SESSION['role'] === 'restricted' && $all == 0){
            $this->set('rest',false);
        }else{
            $this->set('rest',true);
        }
	}

	function edit($id = null) {
        $this->loadModel('Restriction');
        $cli_id = $this->Session->read("Auth.Client.id");
        if($_SESSION['role'] === 'restricted'){
            $stat = $this->Trail->field('station_id',array('id'=>$id));
            $all = $this->Restriction->field('allt',array('client_id'=>$cli_id,'station_id' => $stat,'trail_id'=>$id));
             if($all == 0 && $all != null) {
                $this->set('edit_trail', true);
            }
            else{
                    $a = $this->Restriction->field('allt',array('client_id'=>$cli_id,'station_id' => $stat));
                    if($a == 1){
                        $this->set('edit_trail',true);
                    }else{
                        $this->set('edit_trail',false);
                    }
            }
        }
        else{
            $this->set('edit_trail',true);
        }

	
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid trail', true));
            $this->redirect(array('action' => 'index'));
        }
        $tr = $this->Trail->findById($id);
        if (!$tr) {
            //$this->Session->setFlash(__('Invalid trail', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Trail->save($this->data)) {
                if($this->data['Trail']['archivo']['error'] == 0 &&  $this->data['Trail']['archivo']['size'] > 0){
                    // Informacion del tipo de archivo subido $this->data['Trail']['archivo']['type']
                    //$destino = WWW_ROOT.'uploads'.DS;
                    $destino = WWW_ROOT.'img'.DS;
                    move_uploaded_file($this->data['Trail']['archivo']['tmp_name'], $destino.$this->data['Trail']['archivo']['name']);
                    $id = $this->data['Trail']['id'];
                    $this->Trail->read(null, $id);
                    $this->Trail->set('image', $this->data['Trail']['archivo']['name']);
                    $this->Trail->save();
                }
                $this->Session->setFlash(__('The trail has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The trail could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Trail->read(null, $id);

		$trail = $this->Trail->findById($id);
		//$trail = $this->Trail->findById($id, array('contain' => false));
		$this->set('trail', $trail);
        }
        $stations = $this->Trail->Station->find('list');
        $this->set(compact('stations'));
        
        if($_SESSION['role'] === 'restricted')
        {
        	$this->loadModel('Restriction');
        	$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
        }
    }

    function candelete($id){
        $canDelete = 0;
        $this->loadModel('Restriction');
        $rests = $this->Restriction->findAllByClientId($this->Session->read('Auth.Client.id'));
        foreach($rests as $res):
            $trail = $this->Trail->read(null, $id);
            if( $res['Restriction']['station_id'] == $trail['Trail']['station_id']&& ($res['Restriction']['trail_id']==$id || $res['Restriction']['allt']==1) ){
                $canDelete = 1;
            }
        endforeach;
        return $canDelete;
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for trail', true));
            $this->redirect(array('action'=>'index'));
        }
        $canDelete = 0;
        $this->loadModel('Restriction');
        $rests = $this->Restriction->findAllByClientId($this->Session->read('Auth.Client.id'));
        foreach($rests as $res):
            $trail = $this->Trail->read(null, $id);
            if( $res['Restriction']['station_id'] == $trail['Trail']['station_id']&& ($res['Restriction']['trail_id']==$id || $res['Restriction']['allt']==1) ){
                $canDelete = 1;
            }
        endforeach;
        if($this->Session->read('Auth.Client.role') =='admin' || $canDelete == 1){
            if ($this->Trail->delete($id)) {
                $this->Session->setFlash(__('Trail deleted', true));
                $this->redirect(array('action'=>'index'));
            }
        }
        $this->Session->setFlash(__('Trail was not deleted', true));
        $this->redirect(array('action' => 'index'));

        if($_SESSION['role'] === 'restricted')
        {
            $this->loadModel('Restriction');
            $this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
        }
    }

    /*
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for trail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Trail->delete($id)) {
			$this->Session->setFlash(__('Trail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Trail was not deleted', true));
		$this->redirect(array('action' => 'index'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}*/

	    public function getByStation($client_id,$station_id) {
                    $seltrails = $this->Trail->find('list', array(
                'conditions' => array('Trail.station_id' => $station_id)
            ));

            $this->set('seltrails',$seltrails);

        $trails_id_number = array();



            foreach ($seltrails as $key => $value):
            array_push($trails_id_number,$key);
            endforeach;

            $this->set('trails_id_number',$trails_id_number);

        $client_permissions = array();
        for($i = 0; $i<sizeof($trails_id_number); $i++)
        {
           /*Contiene los ids de los trails donde el cliente seleccionado posee permisos*/
            $last_record = $this->Restriction->find('first', array(
                'conditions' => array('Restriction.client_id' => $client_id,'Restriction.station_id'=>$station_id,'Restriction.trail_id'=>$trails_id_number[$i]),'fields'=>array('trail_id')
            ));
            if($last_record!=NULL) {
                array_push($client_permissions, $last_record);
            }

        }
            $clients_per = array();
            for($n = 0; $n<sizeof($client_permissions); $n++)
            {
                   // echo($client_permissions[$n]['Restriction']['trail_id']);
                    array_push($clients_per, $client_permissions[$n]["Restriction"]["trail_id"]);

            }

            if($this->Restriction->find('first', array('conditions' => array('Restriction.client_id' => $client_id,'Restriction.station_id'=>$station_id,'Restriction.trail_id'=>null),'fields'=>array('trail_id')))!=null)
            {
                array_push($clients_per, -1);
            }


            $this->set('client_permissions',$client_permissions);
            $this->set('clients_per',$clients_per);


        $this->layout = 'ajax';
        
    }
	//nada ...
}
