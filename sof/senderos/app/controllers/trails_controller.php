<?php
class TrailsController extends AppController {

	var $name = 'Trails';


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
                    echo('helo');
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
		$stations = $this->Trail->Station->find('list');
		$this->set(compact('stations'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid trail', true));
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

	    public function getByStation() {
        $station_id = $this->data['Restriction']['station_id'];
        $seltrails = $this->Trail->find('list', array(
            'conditions' => array('Trail.station_id' => $station_id)
        ));

        $this->set('seltrails',$seltrails);
        $this->layout = 'ajax';
        
    }
	//nada ...
}
