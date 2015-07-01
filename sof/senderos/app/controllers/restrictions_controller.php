<?php
class RestrictionsController extends AppController {
	var $name = 'Restrictions';
    var $uses = array('Restriction', 'Client', 'Station', 'Trail');
	public $helpers = array('Js');

	var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Restriction.station_id' => 'asc',
            'Restriction.client_id' => 'asc',
            'Restriction.trail_id' => 'asc'
        )
    );
	
    function index() {
        $this->Restriction->recursive = 0;
        $this->set('restrictions', $this->paginate());
        //$restrictions = $this->Restriction->find('all');
        //$this->set(compact('restrictions'));
    }

    function add() {
        if (!empty($this->data)) {
            for ($i=0; $i<sizeof($this->data['Restriction']['trail_id']); $i++) {
                if($this->data['Restriction']['trail_id'][$i]!=-1)
                {
                    $row = $this->Restriction->find('first', array('conditions' => array('Restriction.client_id' => $this->data['Restriction']['client_id'],'Restriction.station_id'=>$this->data['Restriction']['station_id'],'Restriction.trail_id'=>$this->data['Restriction']['trail_id'][$i])));
                    if($row==null)
                    {
                        $this->Restriction->create();
                        $this->Restriction->save(Array('Restriction' => Array('trail_id' => $this->data['Restriction']['trail_id'][$i], 'client_id' => $this->data['Restriction']['client_id'], 'station_id' => $this->data['Restriction']['station_id'], 'allt' => 0)));
                    }
                }
                else{
                    $row = $this->Restriction->find('first', array('conditions' => array('Restriction.client_id' => $this->data['Restriction']['client_id'], 'Restriction.station_id' => $this->data['Restriction']['station_id'], 'Restriction.trail_id' => NULL)));
                    if ($row == null) {
                        $this->Restriction->query("INSERT INTO restrictions (client_id,station_id,trail_id,allt) values("+$this->data['Restriction']['client_id']+","+$this->data['Restriction']['station_id']+","+1000+","+1+")");
                    }

                }
            }

            $this->Session->setFlash(__('Restriction Saved'.sizeof($this->data['Restriction']['trail_id']), true));
            $this->redirect(array('controller'=>'restrictions','action' => 'index'));
            /*if ($this->Restriction->save($this->data)) {
                $this->Session->setFlash(__('The restriction has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The restriction could not be saved. Please, try again.'.$this->data[Restriction][trail_id][0], true));
            }*/
        }
        //$this->set('restrictions', $this->Restriction->find('all', array('order' => array('Restriction.model ASC'), 'conditions' => array('Restriction.client_id' => $this->Client->id))));
        $this->set('restrictions', $this->Restriction->find('all'));//, array('order' => array('Restriction.model ASC'))));
        $stations = $this->Station->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('stations'));
        $trails = $this->Trail->find('list');// array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('trails'));
        $clients = $this->Client->find('list', array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('clients'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid restriction', true));
            $this->redirect(array('action' => 'index'));
        }
        $re = $this->Restriction->findById($id);
        if (!$re) {
            //$this->Session->setFlash(__('Invalid restriction', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Restriction->save($this->data)) {
                $this->Session->setFlash(__('The restriction has been saved', true));
                return $this->redirect(array('action' => 'index', $this->Restriction->id));
            } else {
                $this->Session->setFlash(__('The restriction could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Restriction->read(null, $id);
        }
        //$this->set('restrictions', $this->Restriction->find('all', array('order' => array('Restriction.model ASC'), 'conditions' => array('Restriction.client_id' => $this->Client->id))));
        $this->set('restrictions', $this->Restriction->find('all')); //, array('order' => array('Restriction.model ASC'))));
        $stations = $this->Station->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('stations'));
        $trails = $this->Trail->find('list');//, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('trails'));
        $clients = $this->Client->find('list', array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('clients'));
    }

    function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for restriction', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Restriction->delete($id)) {
			$this->Session->setFlash(__('Restriction deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Restriction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
