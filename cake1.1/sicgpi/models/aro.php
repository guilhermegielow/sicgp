<?php
class Aro extends AppModel {

	var $name = 'Aro';
	var $validate = array(
		'lft' => VALID_NOT_EMPTY,
		'rght' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Aco' =>
				array('className' => 'Aco',
						'joinTable' => 'aros_acos',
						'foreignKey' => 'aro_id',
						'associationForeignKey' => 'aco_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Aro"]["id"])){
             $this->data["Aro"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Aro"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
