<?php

class DocumentsController extends AppController {

	var $name = 'Documents';


var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Document.id' => 'asc'
        )
    );


    var $uses = array('Document', 'Visitor', 'Language');
	
	function beforeFilter() {
		parent::BeforeFilter();
        $this->Auth->allow('index', 'view', 'display');

    }
	
	function index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
		
		$this->loadModel('DocumentsPoint');
		$this->loadModel('Station');
		$this->loadModel('Trail');
        $this->set('dopos', $this->DocumentsPoint->find('all'));
		$this->set('stations', $this->Station->find('all'));
		$this->set('trails', $this->Trail->find('all'));
        //debug($this->DocumentsPoint->find('all'));
        if($_SESSION['role'] === 'restricted')
        {
            $this->loadModel('Restriction');
            $this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
        }
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('document', $this->Document->read(null, $id));
	}

    function add() {
		if (!empty($this->data)) {
			$this->Document->create();
			if ($this->Document->save($this->data)) {
                if($this->data['Document']['archivo']['error'] == 0 &&  $this->data['Document']['archivo']['size'] > 0){
                    $nombre =  $this->data['Document']['archivo']['name'];
                    $posicion = stripos($nombre,".");
                    $terminacion = substr($nombre,$posicion+1);
                    $destino = WWW_ROOT.'files'.DS;

                    switch($terminacion) {
                        case "doc": $destino = WWW_ROOT.'text'.DS; break;
                        case "docx": $destino = WWW_ROOT.'text'.DS; break;
                        case "txt": $destino = WWW_ROOT.'text'.DS; break;
                        case "odt": $destino = WWW_ROOT.'text'.DS; break;
                        case "mp3": $destino = WWW_ROOT.'sound'.DS; break;
                        case "wav": $destino = WWW_ROOT.'sound'.DS; break;
                        case "avi": $destino = WWW_ROOT.'sound'.DS; break;
                        case "flv": $destino = WWW_ROOT.'video'.DS; break;
                        case "wmv": $destino = WWW_ROOT.'video'.DS; break;
                        case "mov": $destino = WWW_ROOT.'video'.DS; break;
                        case "mp4": $destino = WWW_ROOT.'video'.DS; break;
                        case "jpg": $destino = WWW_ROOT.'images'.DS; break;
                        case "jpeg": $destino = WWW_ROOT.'images'.DS; break;
                        case "gif": $destino = WWW_ROOT.'images'.DS; break;
                        case "png": $destino = WWW_ROOT.'images'.DS; break;
                        case "bmp": $destino = WWW_ROOT.'images'.DS; break;
                        default:  $destino = WWW_ROOT.'files'.DS;
                    }

                    move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name']);
                    $this->Document->set('route', $this->data['Document']['archivo']['name']);
                    $this->Document->save();
                    $id_document = $this->Document->getLastInsertID();
                    if(sizeof($this->data['Document']['targets'])>0){
                        for($i = 0; $i<sizeof($this->data['Document']['targets']); $i++)
                        {
                            $this->Visitor->create();
                            $this->Visitor->save(Array('Visitor' => Array('role' => $this->data['Document']['targets'][$i] ,'document_id' => $id_document)));
                        }
                    }
                }
				$this->Session->setFlash(__('The document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.', true));
			}
		}
		$languages = $this->Language->find('list'); //, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('languages'));
	}

    function edit($id = null) {
        $this->loadModel('Restriction');
        $this->loadModel();
        $cli_id = $this->Session->read("Auth.Client.id");
        if($_SESSION['role'] === 'restricted'){
            //Cargo Modelos
            $this->loadModel('DocumentsPoint');
            $this->loadModel('Station');
            $this->loadModel('Trail');
            $this->loadModel('Point');
            $po_id = $this->DocumentsPoint->field('point_id',array('document_id'=>$id));
            $tr_id = $this->Point->field('trail_id',array('id'=>$po_id));
            $st_id = $this->Trail->field('station_id',array('id'=>$tr_id));
            $all = $this->Restriction->field('allt',array('client_id'=>$cli_id,'station_id' => $st_id,'trail_id'=>$tr_id));
            if($all == 0 && $all != null) {
                $this->set('edit_doc', true);
            }
            else{
                $a = $this->Restriction->field('allt',array('client_id'=>$cli_id,'station_id' => $st_id));
                if($a == 1){
                    $this->set('edit_doc',true);
                }else{
                    $this->set('edit_doc',false);
                }
            }
        }
        else{
            $this->set('edit_doc',true);
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid document', true));
            $this->redirect(array('action' => 'index'));
        }
        $do = $this->Document->findById($id);
        if (!$do) {
            //$this->Session->setFlash(__('Invalid document', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The country could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Document->read(null, $id);
        }
        $languages = $this->Language->find('list'); //, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('languages'));
    }

    /*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
            $document = $this->Document->read(null, $id);
            $this->Document->set('name', $this->data['Document']['name']);
            $this->Document->set('description', $this->data['Document']['description']);
            $this->Document->set('type', $this->data['Document']['type']);
            $this->Document->set('language', $this->data['Document']['language']);
            $this->Document->save();
            $this->redirect(array('action' => 'index'));
        }
		if (empty($this->data)) {
			$this->data = $this->Document->read(null, $id);
		}
		$languages = $this->Language->find('list'); //, array('conditions'=>array('Client.role =' => 'cust')));
        $this->set(compact('languages'));
	}*/

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document', true));
			$this->redirect(array('action'=>'index'));
		}
            $document = $this->Document->read(null, $id);
            $conditions = array('document_id'=>$id);
           // $this->Visitor->deleteAll($conditions, $cascade = true, $callbacks = false);
            $file = new File(WWW_ROOT ."/".$document['Document']['type']."/".$document['Document']['route'], false, 0777);//Si esta sirviendo esta fallando la ruta >.>
            $file->delete();
            $this->loadModel('DocumentsPoints');
            $this->DocumentsPoints->deleteAll(array('DocumentsPoints.document_id' => $id));
            $this->Document->delete($id,true);
			$this->Session->setFlash(__('Document deleted', true));
			$this->redirect(array('action'=>'index'));
		$this->redirect(array('action' => 'index'));
	}
}
