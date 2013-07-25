<?php
App::import('Vendor', 'Hashids');

class UrlhashComponent extends Component {
	private $_securitysalt;
	
	function __construct() {
		$this->_securitysalt = Configure::read('Security.salt');
	}
	
	public function encrypt($id) {
		$hashids = new Hashids\Hashids($this->_securitysalt);
		
		return $hashids->encrypt(intval($id));
	}
	
	public function decrypt($hash) {
		$hashids = new Hashids\Hashids($this->_securitysalt);
		
		$decryptedHash = $hashids->decrypt($hash);
		
		return $decryptedHash[0];
	}
}