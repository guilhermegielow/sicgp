<?php
class Premissa extends AppModel {

	var $name = 'Premissa';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_premissa' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Premissa"]["id"])){
             $this->data["Premissa"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Premissa"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
