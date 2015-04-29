<?php
class DocumentsController extends AppController {

	var $name = 'Documents';

	function index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('document', $this->Document->read(null, $id));
	}

    function add() {
        $this->layout= '';
		if (!empty($this->data)) {
			$this->Document->create();
			if ($this->Document->save($this->data)) {
                if($this->data['Document']['archivo']['error'] == 0 &&  $this->data['Document']['archivo']['size'] > 0){
                    // Informacion del tipo de archivo subido $this->data['Trail']['archivo']['type']
                    //$destino = WWW_ROOT.'uploads'.DS;
                    $nombre =  $this->data['Document']['archivo']['name'];
                    $terminacion = substr($nombre,strlen($nombre)-3);
                    $destino = WWW_ROOT.'files'.DS;
                    switch($terminacion) {
                        case "doc": $destino = WWW_ROOT.'text'.DS; break;
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
                        case "png": $destino = WWW_ROOT.'images'.DS; break;
                        default:  $destino = WWW_ROOT.'files'.DS;
                    }
                    move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name']);
                    $id = $this->data['Document']['id'];
                    $this->Document->read(null, $id);
                    $tipo = $nombre =  $this->data['Document']['archivo']['Document.type'];
                    switch($tipo)
                    {
                        case "0": $tipo = "video"; break;

                        case "1": $tipo = "text"; break;

                        case "2": $tipo = "img"; break;

                        default: $tipo = "sound"; break;

                    }
                    $this->Document->set('type', $tipo);
                    $this->Document->set('route', $this->data['Document']['archivo']['name']);
                    $this->Document->save();
                }
				$this->Session->setFlash(__('The document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid document', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
            $nombre =  $this->data['Document']['archivo']['name'];
            $terminacion = substr($nombre,strlen($nombre)-3);
            $destino = WWW_ROOT.'files'.DS;
            switch($terminacion) {
                case "doc": $destino = WWW_ROOT.'text'.DS; break;
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
                case "png": $destino = WWW_ROOT.'images'.DS; break;
                default:  $destino = WWW_ROOT.'files'.DS;
            }
            move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name']);
            $id = $this->data['Document']['id'];
            $this->Document->read(null, $id);
            $tipo = $this->data['Document']['archivo']['Document.type'];
            switch($tipo)
            {
                case "0": $tipo = "video"; break;

                case "1": $tipo = "text"; break;

                case "2": $tipo = "img"; break;

                default: $tipo = "sound"; break;

            }
            $this->Document->set('type', $tipo);
            $this->Document->set('route', $this->data['Document']['archivo']['name']);
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash(__('The document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Document->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document', true));
			$this->redirect(array('action'=>'index'));
		}
		//if ($this->Document->delete($id)) {
            //Tengo que hacer la consulta para sacar el path
            $document = $this->Document->read(null, $id);
            $file = new File(WWW_ROOT ."/".$document['Document']['type']."/".$document['Document']['route'], false, 0777);//Si esta sirviendo esta fallando la ruta >.>
            $file->delete();
            $this->Document->delete($id);
			$this->Session->setFlash(__('Document deleted'.WWW_ROOT .$document['Document']['type']."/".$document['Document']['route'], true));
			$this->redirect(array('action'=>'index'));
		//}
		//$this->Session->setFlash(__('Document was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
