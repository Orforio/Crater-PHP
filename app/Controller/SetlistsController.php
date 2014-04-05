<?php
class SetlistsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Track', 'Js' => array('Jquery'));
	public $components = array('Session', 'Security', 'Urlhash');
	public $uses = array('Setlist', 'Track', 'Key');

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
			'conditions' => array(
				'Setlist.id' => $id
				),
			'contain' => array(
				'Track',
				'Track.KeyStart',
				'Track.KeyEnd'
				)
			)
		);

        if (!$setlist) {
			throw new NotFoundException(__('Invalid setlist'));
		}

		$setlist['Setlist']['urlhash'] = $urlHash;

		if ($setlist['Setlist']['master_bpm']) {
			foreach ($setlist['Track'] as $i => $track) {
				$track = $this->Track->calculateBPMDifference($track, $setlist['Setlist']['master_bpm']);
				$setlist['Track'][$i] = $this->Track->calculateKeyDifference($track);

				if (!empty($setlist['Track'][$i]['key_start_modified'])) {	// Replace the modified Key.id with the entire row from the DB
					$setlist['Track'][$i]['key_start_modified'] = $this->Key->findById($setlist['Track'][$i]['key_start_modified']);
				}
			}
		}
	//	debug($setlist);
		$this->set('setlist', $setlist);
	}

	public function add() {	// Adds a new setlist
		if ($this->request->is('post')) {
			$this->Setlist->create();
			
			if ($strippedRequestData = $this->_stripBlankPostData($this->request->data)) {
				$strippedRequestData['Setlist']['private_key'] = $this->generatePrivateKey();
				
				if ($this->Setlist->saveAssociated($strippedRequestData)) {
					$this->Session->setFlash('Your setlist has been saved', 'flash_success_dismissable');
					return $this->redirect(array(
						'action' => 'edit',
						$this->Urlhash->encrypt($this->Setlist->getLastInsertID()),
						$this->request->data['Setlist']['private_key']
					));
				} else {
					$this->Session->setFlash("Something went wrong and your setlist hasn't been saved yet - please check for any errors below and try again", 'flash_danger_dismissable');
	
					usort($this->request->data['Track'], array($this, "sortOrder"));
					//debug($this->Setlist->validationErrors);
				}

			} else {
				$this->Session->setFlash("Please enter at least two tracks before saving", 'flash_danger_dismissable');
				usort($this->request->data['Track'], array($this, "sortOrder"));
			}
			
		}
        
		$keys = $this->Key->find('all');
		$this->set('keys', $keys);
	}
    
	public function edit($urlHash = null, $privateKey = null) {	// Edits an existing setlist
	    if (!$urlHash) {
	        throw new NotFoundException(__('Invalid setlist'));
	    }
	    elseif (!$privateKey) {
	    	if (!isset($this->request->query['editkey'])) {
		    	$this->Session->setFlash("You need this setlist's Edit Key to update it", 'flash_danger_dismissable');
				$this->redirect(array('action' => 'view', $urlHash));
	    	}
	    	else {
	    		return $this->redirect(array('action' => 'edit', $urlHash, $this->request->query['editkey']));
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
		    $this->Session->setFlash("You need this setlist's Edit Key to update it", 'flash_danger_dismissable');
		    return $this->redirect(array('action' => 'view', $urlHash));
	    }
	    
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->request->data = $this->_stripBlankPostData($this->request->data)) {
				$this->Setlist->id = $decryptedID;
				if ($this->Setlist->saveAssociated($this->request->data)) {
					$this->Session->setFlash('Your setlist has been updated', 'flash_success_dismissable');
					
					return $this->redirect(array(
						'action' => 'edit',
						$urlHash,
						$privateKey
					));
		        } else {
		            $this->Session->setFlash("Something went wrong and your setlist hasn't been updated", 'flash_danger_dismissable');
		           
					$setlist = array_replace_recursive($setlist, $this->request->data);
					usort($this->request->data['Track'], array($this, "sortOrder"));
					usort($setlist['Track'], array($this, "sortOrder"));
				}
			} else {
				$this->Session->setFlash("Please enter at least two tracks before saving", 'flash_danger_dismissable');

				$setlist = array_replace_recursive($setlist, $this->request->data);
				usort($this->request->data['Track'], array($this, "sortOrder"));
				usort($setlist['Track'], array($this, "sortOrder"));
			}
	    }
		
		$setlist['Setlist']['suggested_bpm'] = $this->Setlist->calculateAverageBPM($setlist['Track']);
		$setlist['Setlist']['urlhash'] = $urlHash;
		
		$this->set('setlist', $setlist);
		
		$keys = $this->Key->find('all');
		$this->set('keys', $keys);

	    if (!$this->request->data) {
	        $this->request->data = $setlist;
	    }
	    
//	    debug($this->Setlist->validationErrors);
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
		$this->autoRender = false;	// This is currently an AJAX-only function
	
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
			'recursive' => 2));
			
		if(count($track['Setlist']['Track']) <= 2) {
			throw new ForbiddenException(__('Setlist contains 2 tracks or fewer'));
		}
			
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
	
	protected function _stripBlankPostData($data) {	// Ensures only form data with rows that have a title filled in are passed on to be saved
		$strippedData['Setlist'] = $data['Setlist'];
		$numberTracks = 0;
		
		foreach ($data['Track'] as $i => $track) {
			if ((strlen($track['title']) > 0) || (strlen($track['artist']) > 0)) {
				$strippedData['Track'][] = $data['Track'][$i];
				$numberTracks++;
			}
		}
		
		if ($numberTracks >= 2) {
			return $strippedData;
		}
		else {
			return false;
		}
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
		$this->Security->unlockedActions = array('deletetrack');
		$this->Security->unlockedFields = array('Track.id', 'Track.setlist_order', 'Track.artist', 'Track.title', 'Track.label', 'Track.length', 'Track.bpm_start', 'Track.key_start');
		$this->Security->blackHoleCallback = 'blackhole';
		$this->Security->csrfUseOnce = false;
	}
	
	public function blackhole($type) {
		$this->Session->setFlash('Your request was ignored by the server for this reason: ' . h($type), 'flash_danger_dismissable');
		return $this->redirect(array('action' => 'index'));
	}
}