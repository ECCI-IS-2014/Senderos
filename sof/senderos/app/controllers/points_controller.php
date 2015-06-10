<?php
class PointsController extends AppController {

	var $name = 'Points';

	var $helpers = array('Html','Ajax','Javascript');
	var $components = array('RequestHandler');

	function beforeFilter() {
		parent::BeforeFilter();
		$this->Auth->allow('getinfo', 'multimedia', 'documents', 'index', 'view', 'display', 'infooptions', 'updatexy');
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
	
		$resp = "";
	
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for point', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->loadModel('Documents');
		$this->loadModel('DocumentsPoint');
		
		$documents = $this->Point->DocumentsPoint->findAllByPointId($id);
		
		$this->loadModel('DocumentsVisitor');
		$this->loadModel('DocumentsLanguage');
		$this->loadModel('DocumentsPoint');
		
		debug($documents);
		
		foreach($documents as $document):
				$doc_id = $document['DocumentsPoint']['document_id'];
				
				
				
				if($this->DocumentsVisitor->deleteAll(array("DocumentsVisitor.document_id" => $doc_id)))
					$resp .= "";
					
				if($this->DocumentsLanguage->deleteAll(array("DocumentsLanguage.document_id" => $doc_id)))
					$resp .= "";
				
			
		endforeach;
		
		if ($this->Point->delete($id)) {
			$resp .= 'Point deleted';
			$this->Session->setFlash(__($resp, true));
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

	/*
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
	}*/

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
                $this->loadModel('Language');
                $this->loadModel('DocumentsLanguage');
                $this->loadModel('DocumentsVisitor');
                $roles = $this->Visitor->findAllByRole($_SESSION['role']);
                $lans = $this->Language->findAllById($_SESSION['language']);
                foreach($lans as $lan)
                {
                    $doclans = $this->Point->DocumentsLanguage->findAllByLanguageId($lan['Language']['id']);
                }
				foreach($pointdocuments as $pointdocument)
                {
					$show = 'no';
                    foreach($roles as $role)
                    {
                        $visitors = $this->Point->DocumentsVisitor->findAllByVisitorId($role['Visitor']['id']);
                    }
					foreach ($visitors as $visitor)
                    {
						if($visitor['DocumentsVisitor']['document_id'] == $pointdocument['Document']['id'])
						{
                            foreach ($doclans as $doclan)
                            {
							    if(($doclan['DocumentsLanguage']['language_id'] == $_SESSION['language'])&&($doclan['DocumentsLanguage']['document_id'] == $pointdocument['Document']['id']))
							    {
								    $show = 'yes';
								    break;
							    }
                            }
						}
					}
					
					if($show === 'yes')
					{
						$cont++;
						if($pointdocument['Document']['type'] === 'video') $video++;
						else if($pointdocument['Document']['type'] === 'text') $text++;
						else if($pointdocument['Document']['type'] === 'images') $image++;
						else if($pointdocument['Document']['type'] === 'sound') $sound++;
						else continue;
					}
                }
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


	function savefile($id = null)
	{
		$response = "";
		$this->autoRender = false;
		if (!$id && empty($this->data)) {
			$response .= 'Invalid point';
		}
		if (!empty($this->data)) {
			$this->loadModel('Document');
			$texto = false;
			if($this->data['Document']['type'] === 'text')
				$texto = true;

			//if brings a file or if just text
			if(($this->data['Document']['archivo']['error'] == 0 &&  $this->data['Document']['archivo']['size'] > 0) || $texto)
			{
				$destino = WWW_ROOT.'other'.DS;

				if(!$texto){
					$nombre =  $this->data['Document']['archivo']['name'];
					$terminacion = $this->data['Document']['type'];
					
					switch($terminacion) {
						case "video": $destino = WWW_ROOT.'video'.DS; break;
						case "text": $destino = WWW_ROOT.'text'.DS; break;
						case "images": $destino = WWW_ROOT.'images'.DS; break;
						case "sound": $destino = WWW_ROOT.'sound'.DS; break;
						default:  $destino = WWW_ROOT.'other'.DS;
					}
				}
				
				//if can upload the file or if just text
				if((move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name'])) || $texto)
				{
					if(!$texto)
					{
						/*** nuevo ***/
						if($this->data['Document']['type'] === 'video')
						{
							$video = WWW_ROOT.'video'.DS.$this->data['Document']['archivo']['name'];
							$to = "".WWW_ROOT.'video'.DS.$this->data['Document']['archivo']['name'].".flv";

							$convertresult=(exec("ffmpeg -i \"".$video."\"  \"".$to."\"  2>&1",$output));

							$this->data['Document']['route'] = $this->data['Document']['archivo']['name'].'.flv';

							unlink($video);

						}
						else
						{
							$this->data['Document']['route'] = $this->data['Document']['archivo']['name'];
						}
						/*** /nuevo **/
					}

					// if saves the document
					if ($this->Document->save($this->data))
					{
						$newdocumentid = $this->Document->getLastInsertId();
						
						$response .= 'The file has been saved';

						if($newdocumentid != null)
							$response .= ' with id:'.$newdocumentid.'';
						
						
						if(!$id == null) //if a point
						{
							$this->loadModel('DocumentsPoint');
							
							$newdocumentpoint['DocumentsPoint']['document_id'] = $newdocumentid;
							$newdocumentpoint['DocumentsPoint']['point_id'] = $id;
							
							if($this->DocumentsPoint->save($newdocumentpoint) || $saved == 1)
							{
								$response .= '';//'<br>and has been associated.';

								//save document_visitor
								$this->loadModel('DocumentsVisitor');
								$conditions = array ("DocumentsVisitor.document_id" => $newdocumentid);
								$this->DocumentsVisitor->deleteAll($conditions); 

								if(isset($this->data['Document']['visitors']))
									$visitors = explode(';', $this->data['Document']['visitors']);
								else
									$visitors = explode(';', $this->data['Document']['visitors'.$this->data['Document']['id'].'']);

								foreach($visitors as $visitor):
									$this->DocumentsVisitor->create();

									$newvisitor['DocumentsVisitor']['visitor_id'] = $visitor;
									$newvisitor['DocumentsVisitor']['document_id'] = $newdocumentid;
									
									$this->DocumentsVisitor->save($newvisitor);
								endforeach;


								//save document_language
								$this->loadModel('DocumentsLanguage');
								$conditions = array ("DocumentsLanguage.document_id" => $newdocumentid);
								$this->DocumentsLanguage->deleteAll($conditions); 
								
								if(isset($this->data['Document']['languages']))
									$languages = explode(';', $this->data['Document']['languages']);
								else
									$languages = explode(';', $this->data['Document']['languages'.$this->data['Document']['id'].'']);

								foreach($languages as $language):
									$this->DocumentsLanguage->create();

									$newlanguage['DocumentsLanguage']['language_id'] = $language;
									$newlanguage['DocumentsLanguage']['document_id'] = $newdocumentid;
									
									$this->DocumentsLanguage->save($newlanguage);
								endforeach;
							}
							else
							{
								$response .= '';//'<br>but could not be associated.';
							}
						}//if a point
						
					} //if saved
					else {
						//delete the uploaded file
						$response .= '';//'The file could not be saved. Please, try again.';
					}
				}
				else 
				{
					$response .= '';//'Upload error';
				}
			}//brings a file
		}//1empty
		if (empty($this->data)) {
			//$this->data = $this->Point->read(null, $id);
			$response .= 'Empty data.';
		}
		
		echo $response;
	}

	function editfile($id = null)
	{
		$response = "";
		$this->autoRender = false;
		if (!$id && empty($this->data)) {
			$response .= 'Invalid point';
		}
		if (!empty($this->data)) {
			$this->loadModel('Document');
			$texto = false;
			if($this->data['Document']['type'] === 'text')
				$texto = true;

			//if brings a file or if just text
			if(($this->data['Document']['archivo']['error'] == 0 &&  $this->data['Document']['archivo']['size'] > 0) || $texto)
			{
				$destino = WWW_ROOT.'other'.DS;
				if(!$texto){
					$nombre =  $this->data['Document']['archivo']['name'];
					$terminacion = $this->data['Document']['type'];
					switch($terminacion) {
						case "video": $destino = WWW_ROOT.'video'.DS; break;
						case "text": $destino = WWW_ROOT.'text'.DS; break;
						case "images": $destino = WWW_ROOT.'images'.DS; break;
						case "sound": $destino = WWW_ROOT.'sound'.DS; break;
						default:  $destino = WWW_ROOT.'other'.DS;
					}
				}
				
				//if can upload the file or if just text
				if((move_uploaded_file($this->data['Document']['archivo']['tmp_name'], $destino.$this->data['Document']['archivo']['name'])) || $texto)
				{
					if(!$texto)
					{
						/*** nuevo ***/
						if($this->data['Document']['type'] === 'video')
						{
							$video = WWW_ROOT.'video'.DS.$this->data['Document']['archivo']['name'];
							$to = "".WWW_ROOT.'video'.DS.$this->data['Document']['archivo']['name'].".flv";

							$convertresult=(exec("ffmpeg -i \"".$video."\"  \"".$to."\"  2>&1",$output));

							$this->data['Document']['route'] = $this->data['Document']['archivo']['name'].'.flv';

							unlink($video);

						}
						else
						{
							$this->data['Document']['route'] = $this->data['Document']['archivo']['name'];
						}
						/*** /nuevo **/
					}

					// if saves the document
					if ($this->Document->save($this->data))
					{
						$newdocumentid = $this->data['Document']['id'];
						
						$response .= 'The file has been updated';

						if($newdocumentid != null)
							$response .= ' with id:'.$newdocumentid.'';

						//save document_visitor
						$this->loadModel('DocumentsVisitor');
						$conditions = array ("DocumentsVisitor.document_id" => $newdocumentid);
						$this->DocumentsVisitor->deleteAll($conditions); 

						if(isset($this->data['Document']['visitors']))
							$visitors = explode(';', $this->data['Document']['visitors']);
						else
							$visitors = explode(';', $this->data['Document']['visitors'.$this->data['Document']['id'].'']);

						foreach($visitors as $visitor):
							$this->DocumentsVisitor->create();

							$newvisitor['DocumentsVisitor']['visitor_id'] = $visitor;
							$newvisitor['DocumentsVisitor']['document_id'] = $newdocumentid;
							
							$this->DocumentsVisitor->save($newvisitor);
						endforeach;


						//save document_language
						$this->loadModel('DocumentsLanguage');
						$conditions = array ("DocumentsLanguage.document_id" => $newdocumentid);
						$this->DocumentsLanguage->deleteAll($conditions); 
						
						if(isset($this->data['Document']['languages']))
							$languages = explode(';', $this->data['Document']['languages']);
						else
							$languages = explode(';', $this->data['Document']['languages'.$this->data['Document']['id'].'']);

						foreach($languages as $language):
							$this->DocumentsLanguage->create();

							$newlanguage['DocumentsLanguage']['language_id'] = $language;
							$newlanguage['DocumentsLanguage']['document_id'] = $newdocumentid;
							
							$this->DocumentsLanguage->save($newlanguage);
						endforeach;
						
					} //if saved
					else {
						$response .= '';//'The file could not be saved. Please, try again.';
					}
				}
				else 
				{
					$response .= '';//'Upload error';
				}
			}//brings a file

			else //if brings the same file
			{
				if($this->Document->save($this->data))
				{
					$this->loadModel('DocumentsVisitor');
					$conditions = array ("DocumentsVisitor.document_id" => $this->data['Document']['id']);
					$this->DocumentsVisitor->deleteAll($conditions); 
					
					if(isset($this->data['Document']['visitors']))
						$visitors = explode(';', $this->data['Document']['visitors']);
					else
						$visitors = explode(';', $this->data['Document']['visitors'.$this->data['Document']['id'].'']);

					foreach($visitors as $visitor):
						$this->DocumentsVisitor->create();
						$newvisitor['DocumentsVisitor']['visitor_id'] = $visitor;
						$newvisitor['DocumentsVisitor']['document_id'] = $this->data['Document']['id'];
						$this->DocumentsVisitor->save($newvisitor);
					endforeach;

					$this->loadModel('DocumentsLanguage');
					$conditions = array ("DocumentsLanguage.document_id" => $this->data['Document']['id']);
					$this->DocumentsLanguage->deleteAll($conditions); 
					
					if(isset($this->data['Document']['languages']))
						$languages = explode(';', $this->data['Document']['languages']);
					else
						$languages = explode(';', $this->data['Document']['languages'.$this->data['Document']['id'].'']);

					foreach($languages as $language):
						$this->DocumentsLanguage->create();
						$newlanguage['DocumentsLanguage']['language_id'] = $language;
						$newlanguage['DocumentsLanguage']['document_id'] = $this->data['Document']['id'];
						$this->DocumentsLanguage->save($newlanguage);
					endforeach;

					$response .= 'The file has been updated';
				}
			}
		}//1empty
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
		
		//$this->set('rol',$_SESSION['role']);
		
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
			{
				//$this->loadModel('Visitor');
				//$this->set('visitors', $this->Visitor->find('all'));
			}
			else {
				/*$this->loadModel('DocumentsVisitor');
				$this->loadModel('DocumentsLanguage');

				$visitorid = $this->requestAction('/visitors/getid/'.$_SESSION['role'].'');
				//$this->set('visitors', $this->DocumentsVisitor->findAllByDocumentId($id));
				$this->set('visitors', $this->Point->DocumentsVisitor->findAllByVisitorId($visitorid));
				//$this->set('languages', $this->DocumentsLanguage->findAllByDocumentId($id));
				$this->set('languages', $this->Point->DocumentsLanguage->findAllByLanguageId($_SESSION['language']));*/
			}
		}
	}


	function multimedia($id = null)
	{
		$this->layout = 'ajax';	//avoids rendering default layout
		$this->set('what', $_GET['what']);
		$this->set('pointdocuments',$this->Point->DocumentsPoint->findAllByPointId($id));
		
		//$this->set('rol',$_SESSION['role']);
		
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
			{
				//$this->loadModel('Visitor');
				//$this->set('visitors', $this->Visitor->findAllByRole($_SESSION['role']));
			}
			else {
				$this->loadModel('DocumentsVisitor');
				$this->loadModel('DocumentsLanguage');

				$visitorid = $this->requestAction('/visitors/getid/'.$_SESSION['role'].'');
				//$this->set('visitors', $this->DocumentsVisitor->findAllByDocumentId($id));
				$this->set('visitors', $this->Point->DocumentsVisitor->findAllByVisitorId($visitorid));
				//$this->set('languages', $this->DocumentsLanguage->findAllByDocumentId($id));
				$this->set('languages', $this->Point->DocumentsLanguage->findAllByLanguageId($_SESSION['language']));
			}
		}
	}

	//nada ...

}
