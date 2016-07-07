<?php
class Aco extends AppModel {

	var $name = 'Aco';
	var $validate = array(
		'lft' => VALID_NOT_EMPTY,
		'rght' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Aro' =>
				array('className' => 'Aro',
						'joinTable' => 'aros_acos',
						'foreignKey' => 'aco_id',
						'associationForeignKey' => 'aro_id',
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
             if (!isset($this->data["Aco"]["id"])){
             $this->data["Aco"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Aco"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
