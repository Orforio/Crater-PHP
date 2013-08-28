<?php
class SetlistsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Track', 'Js' => array('Jquery'));
    public $components = array('Session', 'Security', 'Urlhash');
    public $uses = array('Setlist', 'Track');
	
	public function index() {
		$setlists = $this->Setlist->find('all');
		
		if (!$setlists) {
			throw new NotFoundException(__('No setlists could be found'));
		}
		
//		if (Configure::read('debug') > 0) {	-- Will eventually have to implement this as a debug-only feature
			foreach ($setlists as $i => $setlist) {
				$setlists[$i]['Setlist']['urlhash'] = $this->Urlhash->encrypt($setlist['Setlist']['id']);
			}
//		}
		
        $this->set('setlists', $setlists);
    }
    
    public function view($urlHash = null) {	// Displays the requested setlist
        if (!$urlHash) {
            throw new NotFoundException(__('No setlist specified'));
        }
        
        $id = $this->Urlhash->decrypt($urlHash);

        $setlist = $this->Setlist->find('first', array(
        	'conditions' => array('Setlist.id' => $id),
        	'recursive' => 1));
        
        if (!$setlist) {
            throw new NotFoundException(__('Invalid setlist'));
        }
        
        $setlist['Setlist']['urlhash'] = $urlHash;
        
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
            $this->request->data['Setlist']['private_key'] = $this->generatePrivateKey();
            if ($this->Setlist->saveAssociated($this->stripBlankPostData($this->request->data))) {
                $this->Session->setFlash('Your setlist has been saved', 'flash_success_dismissable');
                return $this->redirect(array('action' => 'edit', $this->Urlhash->encrypt($this->Setlist->getLastInsertID()), $this->request->data['Setlist']['private_key']));
            } else {
                $this->Session->setFlash('Something went wrong and your setlist hasn\'t been saved yet. Please check for any erorrs below and try again', 'flash_danger_dismissable');
//                debug($this->Setlist->validationErrors);
            }
        }
    }
    
    public function edit($urlHash = null, $privateKey = null) {	// Edits an existing setlist
	    if (!$urlHash) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    elseif (!$privateKey) {
	    	if (!isset($this->request->query['editkey'])) {
		    	$this->Session->setFlash('You need this setlist\'s Edit Key to update it', 'flash_danger_dismissable');
				$this->redirect(array('action' => 'view', $urlHash));
	    	}
	    	else {
		    	$privateKey = $this->request->query['editkey'];
	    	}
	    }
	    
	    $decryptedID = $this->Urlhash->decrypt($urlHash);
	    
	    $setlist = $this->Setlist->find('first', array(
	    	'conditions' => array('Setlist.id' => $decryptedID),
	    	'recursive' => 1));
	
	    if (!$setlist) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    
	    if ($setlist['Setlist']['private_key'] != $privateKey) {
		    $this->Session->setFlash('You need this setlist\'s Edit Key to update it', 'flash_danger_dismissable');
		    return $this->redirect(array('action' => 'view', $urlHash));
	    }
	    
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Setlist->id = $decryptedID;
			if ($this->Setlist->saveAssociated($this->stripBlankPostData($this->request->data))) {
				$this->Session->setFlash('Your setlist has been updated', 'flash_success_dismissable');
				
				return $this->redirect(array('action' => 'edit', $urlHash, $privateKey));
	        } else {
	            $this->Session->setFlash('Something went wrong and your setlist hasn\'t been updated', 'flash_danger_dismissable');
	            
	            //debug($setlist);
				
				$setlist = array_replace_recursive($setlist, $this->request->data);
				usort($this->request->data['Track'], array($this, "sortOrder"));
				usort($setlist['Track'], array($this, "sortOrder"));
			//	debug($this->request->data);
	        }
	    }
		
		$setlist['Setlist']['suggested_bpm'] = $this->Setlist->calculateAverageBPM($setlist['Track']);
		$setlist['Setlist']['urlhash'] = $urlHash;
		
		$this->set('setlist', $setlist);

	    if (!$this->request->data) {
	        $this->request->data = $setlist;
	    }
	}
	
	public function delete($urlHash = null, $privateKey = null) {	// Deletes a setlist
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if (!$urlHash) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    elseif (!$privateKey) {
		    $this->Session->setFlash('You need this setlist\'s Edit Key to delete it', 'flash_danger_dismissable');
		    return $this->redirect(array('action' => 'view', $urlHash));
	    }
	    
	    $decryptedID = $this->Urlhash->decrypt($urlHash);
	    
	    $setlist = $this->Setlist->find('first', array(
	    	'conditions' => array('Setlist.id' => $decryptedID)));
	    	
	    if ($setlist['Setlist']['private_key'] != $privateKey) {
		    $this->Session->setFlash('You need this setlist\'s Edit Key to delete it', 'flash_danger_dismissable');
		    return $this->redirect(array('action' => 'view', $urlHash));
	    }
	
	    if ($this->Setlist->delete($decryptedID, true)) {
	        $this->Session->setFlash('Setlist "' . h($setlist['Setlist']['name']) . '" has been deleted', 'flash_success_dismissable');
	        return $this->redirect(array('action' => 'index'));
	    }
	    else {
		    $this->Session->setFlash('Something went wrong and the setlist couldn\'t be deleted', 'flash_danger_dismissable');
		    return $this->redirect(array('action' => 'view', $urlHash));
	    }
	}

	public function deletetrack($trackID = null, $privateKey = null) {
		$this->autoRender = false;
	
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if (!$trackID) {
			throw new NotFoundException(__('Invalid track'));
		}
		elseif (!$privateKey) {
			throw new NotFoundException(__('Invalid setlist Edit Key'));
		}
		
//		$decryptedID = $this->Urlhash->decrypt($urlHash);
		
		$track = $this->Track->find('first', array(
			'conditions' => array('Track.id' => $trackID),
			'recursive' => 1));
			
		if ($track['Setlist']['private_key'] != $privateKey) {
			throw new NotFoundException(__('Invalid setlist Edit Key'));
		}
		
		if ($this->Track->delete($trackID, false)) {
			return true;
		}
		else {
		    return false;
		}
	}
	
	protected function stripBlankPostData($data) {	// Ensures only form data with rows that have a title filled in are passed on to be saved
		$strippedData['Setlist'] = $data['Setlist'];
		
		foreach ($data['Track'] as $i => $track) {
			if (strlen($track['title']) > 0) {
				$strippedData['Track'][] = $data['Track'][$i];
			}
		}
		return $strippedData;
	}
	
	protected function generatePrivateKey() {
		$secretSeed = rand() . time();
		$secretSeed = str_shuffle($secretSeed);
		$secretSeed = substr($secretSeed, 0, 6);
		
		return $this->Urlhash->encrypt($secretSeed);
	}
	
	private function sortOrder($a, $b) {	// Used by usort to order tracks by their setlist order
		return $a['setlist_order'] > $b['setlist_order'];
	}
	
	public function beforeFilter() {
		//$this->response->disableCache();
		$this->Security->unlockedActions = array('deletetrack');
    	$this->Security->unlockedFields = array('Track.id', 'Track.setlist_order', 'Track.artist', 'Track.title', 'Track.label', 'Track.length', 'Track.bpm_start', 'Track.key_start');
	}
}
?>