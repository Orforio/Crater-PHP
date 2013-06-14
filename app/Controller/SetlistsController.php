<?php
class SetlistsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'DebugKit.Toolbar');
    public $uses = array('Setlist', 'Track');
	
	public function index() {
        $this->set('setlists', $this->Setlist->find('all'));
    }
    
    public function view($id = null) {	// Displays the requested setlist
        if (!$id) {
            throw new NotFoundException(__('Invalid setlist'));
        }

        $setlist = $this->Setlist->findById($id);
        
        if (!$setlist) {
            throw new NotFoundException(__('Invalid setlist'));
        }
        $this->set('setlist', $setlist);
        
		$tracks = $this->Track->find('all', array(
        	'conditions' => array('Track.setlist_id' => $id)
		));
		
		if (!$tracks) {
			throw new NotFoundException(__('No tracks found for requested setlist'));
		}
		
		foreach ($tracks as $i => $track) {	// Appends each key's keycode to the data array
			$tracks[$i]['Track']['key_code_start'] = $this->Track->getKeyCode($track['Track']['key_start']);
		}
		$this->set('tracks', $tracks);
    }
    
    public function add() {	// Adds a new setlist
        if ($this->request->is('post')) {
            $this->Setlist->create();
            if ($this->Setlist->saveAssociated($this->stripBlankPostData($this->request->data))) {
                $this->Session->setFlash('Your setlist has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your setlist.');
//                debug($this->Setlist->validationErrors);
            }
        }
    }
    
    public function edit($id = null) {	// Edits an existing setlist
	    if (!$id) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	
	    $setlist = $this->Setlist->findById($id);
	    if (!$setlist) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    
	    $tracks = $this->Track->find('all', array(
        	'conditions' => array('Track.setlist_id' => $id)
		));
		
		if (!$tracks) {
			throw new NotFoundException(__('No tracks found for requested setlist'));
		}
		$this->set('tracks', $tracks);
	
	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->Setlist->id = $id;
	        if ($this->Setlist->saveAssociated($this->request->data)) {
	            $this->Session->setFlash('Your setlist has been updated.');
	            $this->redirect(array('action' => 'index'));
	        } else {
	            $this->Session->setFlash('Unable to update your setlist.');
	        }
	    }
	
	    if (!$this->request->data) {
	        $this->request->data = $setlist;
	    }
	}
	
	public function delete($id) {	// Deletes a setlist
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	
	    if ($this->Setlist->delete($id, $cascade = true)) {
	        $this->Session->setFlash('The setlist with id: ' . $id . ' has been deleted.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
	
	protected function stripBlankPostData($data) {	// Ensures only form data with rows that have a title filled in are passed on to be saved
		$strippedData['Setlist'] = $data['Setlist'];
		
		foreach ($data['Track'] as $key => $row) {
			if ($row['title']) {
				$strippedData['Track'][] = $data['Track'][$key];
			}
		}
		return $strippedData;
	}
}
?>