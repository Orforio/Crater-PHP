<?php
class SetlistsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Track', 'Js' => array('Jquery'));
    public $components = array('Session', 'Security', 'Urlhash', 'DebugKit.Toolbar');
    public $uses = array('Setlist', 'Track');
	
	public function index() {
        $this->set('setlists', $this->Setlist->find('all'));
    }
    
    public function view($id = null) {	// Displays the requested setlist
        if (!$id) {
            throw new NotFoundException(__('Invalid setlist'));
        }

        $setlist = $this->Setlist->find('first', array(
        	'conditions' => array('Setlist.id' => $id),
        	'recursive' => 1));
        
        if (!$setlist) {
            throw new NotFoundException(__('Invalid setlist'));
        }
        
        $setlist['Setlist']['urlhash'] = $this->Urlhash->encrypt($id);
        
		foreach ($setlist['Track'] as $i => $track) {	// Appends each key's notational form to the data array
			$setlist['Track'][$i]['key_notation_start'] = $this->Track->getKeyNotation($track['key_start']);
		}
		
		if ($setlist['Setlist']['master_bpm']) {
			foreach ($setlist['Track'] as $i => $track) {
				$track = $this->Track->calculateBPMDifference($track, $setlist['Setlist']['master_bpm']);
				$setlist['Track'][$i] = $this->Track->calculateKeyDifference($track);
			}
		}
		
		$this->set('setlist', $setlist);

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
	    
	    $decryptedID = $this->Urlhash->decrypt($id);
	    
	    $setlist = $this->Setlist->find('first', array(
	    	'conditions' => array('Setlist.id' => $decryptedID),
	    	'recursive' => 1));
	
//	    $setlist = $this->Setlist->findById($decryptedID);
	    if (!$setlist) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    
/*	    $tracks = $this->Track->find('all', array(
        	'conditions' => array('Track.setlist_id' => $decryptedID),
        	'order' => array('Track.setlist_order ASC')
		)); */
		
/*		if (!$tracks) {
			throw new NotFoundException(__('No tracks found for requested setlist'));
		}	*/
		
		$setlist['Setlist']['suggested_bpm'] = $this->Setlist->calculateAverageBPM($setlist['Track']);
		
		$this->set('setlist', $setlist);
//		$this->set('tracks', $tracks);
	
	    if ($this->request->is('post') || $this->request->is('put')) {
	        $this->Setlist->id = $decryptedID;
	        if ($this->Setlist->saveAssociated($this->request->data)) {
	            $this->Session->setFlash('Your setlist has been updated.', 'default', array('class' => 'alert alert-success', 'options' => array('data-dismiss' => 'alert')));
	            $this->redirect(array('action' => 'index'));
	        } else {
	            $this->Session->setFlash('Unable to update your setlist.', 'default', array('class' => 'alert alert-error', 'params' => array('data-dismiss' => 'alert')));
	        }
	    }
	
	    if (!$this->request->data) {
	        $this->request->data = $setlist;
	      //  $this->request->data['Track'] = $tracks;
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
		
		foreach ($data['Track'] as $i => $track) {
			if ($track['title']) {
				$strippedData['Track'][] = $data['Track'][$i];
			}
		}
		return $strippedData;
	}
	
	public function beforeFilter() {
    	$this->Security->unlockedFields = array('Track.setlist_order', 'Track.artist', 'Track.title', 'Track.label', 'Track.length', 'Track.bpm_start', 'Track.key_start');
	}
}
?>