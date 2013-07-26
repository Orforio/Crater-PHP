<?php
App::import('Vendor', 'Hashids');

class UrlhashComponent extends Component {
	protected $_securitysalt;
	
	function __construct() {
		$this->_securitysalt = Configure::read('Security.salt');
	}
	
	public function encrypt($id = null) {
		if (!$id || !is_numeric($id)) {
			return '';
		}
		else {
			$hashids = new Hashids\Hashids($this->_securitysalt);
		
			return $hashids->encrypt(intval($id));
		}
	}
	
	public function decrypt($hash = null) {
		$hashids = new Hashids\Hashids($this->_securitysalt);
		
		$decryptedHash = $hashids->decrypt($hash);
		
		if (array_key_exists(0, $decryptedHash)) {
			return $decryptedHash[0];
		}
		else {
			return '';	
		}
	}
}