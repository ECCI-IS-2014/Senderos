<?php
class PointsController extends AppController {

	var $name = 'Points';

	var $helpers = array('Html','Ajax','Javascript');
	var $components = array('RequestHandler');

	function beforeFilter() {
        parent::BeforeFilter();
        $this->Auth->allow('getinfo', 'multimedia', 'documents', 'index', 'view', 'display', 'infooptions');
    }
	
	function index() {
		$this->Point->recursive = 0;
		$this->set('points', $this->paginate());
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('point', $this->Point->read(null, $id));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Point->create();
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
		$trails = $this->Point->Trail->find('list');
		$this->set(compact('trails'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Point->read(null, $id);
		}
		$trails = $this->Point->Trail->find('list');
		$this->set(compact('trails'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for point', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Point->delete($id)) {
			$this->Session->setFlash(__('Point deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Point was not deleted', true));
		$this->redirect(array('action' => 'index'));
		
		if($_SESSION['role'] === 'restricted')
		{
			$this->loadModel('Restriction');
			$this->set('restrictions',$this->Restriction->findAllByClientId($_SESSION['client_id']));
		}
	}

	function multi($id = null) {
		$this->redirect(array('controller' => 'documents', 'action' => 'point', $id));
	}


	//funcion ajax
	function getinfo($id)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp

		$this->set('point', $this->Point->read(null, $id));

		$response = $this->viewVars['point']['Point']['name'].'<br>';
		/*$response .= $this->viewVars['point']['Point']['description'].'<br>';
		$response .= $this->viewVars['point']['Point']['cordx'].'<br>';
		$response .= $this->viewVars['point']['Point']['cordy'].'<br>';*/

		echo $response;
	}

	//funcion ajax
	function infooptions($id)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp

		$pointdocuments = $this->Point->DocumentsPoint->findAllByPointId($id);

		$response = '';

		$video = 0;
		$text = 0;
		$image = 0;
		$sound = 0;

		$cont = 0;

		if(isset($_SESSION['role']))
		{
			if($_SESSION['role'] !== 'administrator' || $_SESSION['role'] !== 'restricted')
			{
                $this->loadModel('Visitor');
                $this->loadModel('DocumentsVisitor');
                $roles = $this->Visitor->findAllByRole($_SESSION['role']);

                foreach($roles as $role)
                {
                    $visitors = $this->DocumentsVisitor->findAllByVisitorId($role['Visitor']['id']);
                }

				foreach($pointdocuments as $pointdocument):

					$show = 'no';
					foreach ($visitors as $visitor):
						if($visitor['DocumentsVisitor']['document_id'] == $pointdocument['Document']['id'])
						{
							if($pointdocument['Document']['language_id'] === $_SESSION['language'])
							{
								$show = 'yes';
								break;
							}
						}
					endforeach;
					
					if($show === 'yes')
					{
						$cont++;
						if($pointdocument['Document']['type'] === 'video') $video++;
						else if($pointdocument['Document']['type'] === 'text') $text++;
						else if($pointdocument['Document']['type'] === 'images') $image++;
						else if($pointdocument['Document']['type'] === 'sound') $sound++;
						else continue;
					}
				endforeach;

			}
		}

		

		if($cont>0)
		{
			$response .= '<ul>';

			if($video > 0)
				$response .= "<li><a onclick=\"ShowMultimedia(".$id.",0);\" style=\"cursor: pointer;\">Videos</a></li>";
			if($text > 0)
				$response .= "<li><a onclick=\"ShowMultimedia(".$id.",1);\" style=\"cursor: pointer;\">Texts</a></li>";
			if($image > 0)
				$response .= "<li><a onclick=\"ShowMultimedia(".$id.",2);\" style=\"cursor: pointer;\">Images</a></li>";
			if($sound > 0)
				$response .= "<li><a onclick=\"ShowMultimedia(".$id.",3);\" style=\"cursor: pointer;\">Sounds</a></li>";
	
			$response .= '</ul>';
		}
		else
			$response = 'empty';

		echo $response;
	}
	
	//funcion ajax
	function explore($id)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp
	
		$point = $this->Point->read(null, $id);
		
		$response ="";
	
		$response .= 'Name<br>'.$point['Point']['name'].'<br>';
		$response .= '<br>CordX<br>'.$point['Point']['cordx'].'<br>';
		$response .= '<br>CordY<br>'.$point['Point']['cordy'].'<br>';
		$response .= '<br>Description<br>'.$point['Point']['description'].'<br>';
		/*$response .= $this->viewVars['point']['Point']['description'].'<br>';
			$response .= $this->viewVars['point']['Point']['cordx'].'<br>';
		$response .= $this->viewVars['point']['Point']['cordy'].'<br>';*/
	
		echo $response;
	}

	//funcion ajax
	function updatexy($id)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp

		$px_x = $_POST["px_x"];
		$px_y = $_POST["px_y"];

		$point = $this->Point->read(null, $id);
		$this->Point->set('px_x', $_POST["px_x"]);
		$this->Point->set('px_y', $_POST["px_y"]);

		if($this->Point->save())
			$response = 'new position saved !!!';
		else
			$response = 'new position not saved !!!';

		//$response = $px_x;

		echo $response;
	}

	function savepoint($id = null)
	{
		$this->autoRender = false; // No renderiza mediate el fichero .ctp

		if (!$id && empty($this->data)) {
			echo 'Invalid point';
		}
		if (!empty($this->data)) {
			if ($this->Point->save($this->data)) {
				echo 'The point has been saved with id:'.$this->Point->getLastInsertId().'';
			} else {
				echo 'The point could not be saved. Please, try again.';
			}
		}
		if (empty($this->data)) {
			//$this->data = $this->Point->read(null, $id);
			echo 'Empty data.';
		}

	}
	
	
	function savenewfile($id = null)
	{
		$saved = 0;
		
		$response = "";
		
		$this->autoRender = false;
		if (!$id && empty($this->data)) {
			$response .= 'Invalid point';
		}
		if (!empty($this->data)) {
			$this->loadModel('Document');
			
			if($this->data['Document']['archivo']['error'] == 0 &&  $this->data['Document']['archivo']['size'] > 0){
				// Informacion del tipo de archivo subido $this->data['Trail']['archivo']['type']
				//$destino = WWW_ROOT.'uploads'.DS;
				$nombre =  $this->data['Document']['archivo']['name'];
				//$terminacion = substr($nombre,strlen($nombre)-3);
				//$terminacion = explode(".",$nombre)[1];
				$terminacion = $this->data['Document']['type'];
				$destino = WWW_ROOT.'other'.DS;
				switch($terminacion) {
					case "0": $destino = WWW_ROOT.'video'.DS; break;
					case "1": $destino = WWW_ROOT.'text'.DS; break;
					case "2": $destino = WWW_ROOT.'images'.DS; break;
					case "3": $destino = WWW_ROOT.'sound'.DS; break;
					case "4": $destino = WWW_ROOT.'other'.DS; break;
					default:  $destino = WWW_ROOT.'other'.DS;
					
					
				}
				
				
				if(move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name']))
				{
					$this->data['Document']['route'] = $this->data['Document']['archivo']['name'];
					if ($this->Document->save($this->data))
					{
						$saved = 1;
						
						$newdocumentid = $this->Document->getLastInsertId();
						
						//$response = "";
						
						$response .= 'The file has been saved';

						if($newdocumentid !== null)
							$response .= 'with id:'.$newdocumentid.'';
						
						
						if(!$id == null) //if a point
						{
							$this->loadModel('DocumentsPoint');
							
							$newdocumentpoint['DocumentsPoint']['document_id'] = $newdocumentid;
							$newdocumentpoint['DocumentsPoint']['point_id'] = $id;
							
							if($this->DocumentsPoint->save($newdocumentpoint))
							{
								$response .= '';//'<br>and has been associated.';

								$this->loadModel('Visitor');
								$conditions = array ("Visitor.document_id" => $newdocumentid);
								$this->Visitor->deleteAll($conditions); 
								$visitors = explode(';', $this->data['Document']['visitors']);

								foreach($visitors as $visitor):
									$this->Visitor->create();

									$newvisitor['Visitor']['role'] = $visitor;
									$newvisitor['Visitor']['document_id'] = $newdocumentid;
									
									$this->Visitor->save($newvisitor);
								endforeach;
							}
							else
							{
								$response .= '';//'<br>but could not be associated.';
							}
						}
						
						//echo $response;
						
						
					}
					else {
						//delete the uploaded file
						$response .= '';//'The file could not be saved. Please, try again.';
					}
				}
				else 
				{
					$response .= '';//'Upload error';
				}
				/*$id = $this->data['Document']['id'];
				$this->Document->read(null, $id);
				$this->Document->set('route', $this->data['Document']['archivo']['name']);
				$this->Document->save();*/
			}
			else{
				
				$response .= '';//'file error';
				
				if ($saved == 0)
				{
					if($this->Document->save($this->data))
					{
						$this->loadModel('Visitor');
						$conditions = array ("Visitor.document_id" => $this->data['Document']['id']);
						$this->Visitor->deleteAll($conditions); 
						$visitors = explode(';', $this->data['Document']['visitors']);

						foreach($visitors as $visitor):
							
							$this->Visitor->create();
							$newvisitor['Visitor']['role'] = $visitor;
							$newvisitor['Visitor']['document_id'] = $this->data['Document']['id'];
							$this->Visitor->save($newvisitor);
						endforeach;

						$response .= 'The file has been updated';
					}
				}
				else
					$response .= '';//'The file could not be uploaded. Please, try again.';
			}
		}
		if (empty($this->data)) {
			//$this->data = $this->Point->read(null, $id);
			$response .= 'Empty data.';
		}
		
		echo $response;
		
	}

	

	function documents($id = null)
	{
		$this->layout = 'ajax';	//avoids rendering default layout
		$this->set('what', $_GET['what']);
		$this->set('pointdocuments',$this->Point->DocumentsPoint->findAllByPointId($id));
		
		$this->set('rol',$_SESSION['role']);
		
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
			{
				$this->loadModel('Visitor');
				$this->set('visitors', $this->Visitor->find('all'));
			}
			else {
				$this->loadModel('Visitor');
				$this->set('visitors', $this->Visitor->findAllByRole($_SESSION['role']));
			}
		}
	}



	function multimedia($id = null)
	{
		$this->layout = 'ajax';	//avoids rendering default layout
		$this->set('what', $_GET['what']);
		$this->set('pointdocuments',$this->Point->DocumentsPoint->findAllByPointId($id));
		
		$this->set('rol',$_SESSION['role']);
		
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
			{

			}
			else {
                $this->loadModel('Visitor');
                $this->loadModel('DocumentsVisitor');
                $roles = $this->Visitor->findAllByRole($_SESSION['role']);

                foreach($roles as $role)
                {
                    $visitors = $this->DocumentsVisitor->findAllByVisitorId($role['Visitor']['id']);
                }
				$this->set('visitors', $visitors);
			}
		}
	}

}
