<?php
class Setlist extends AppModel {
	public $hasMany = array(
		'Track' => array(
			'dependent' => true
			)
		);
	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'author' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>