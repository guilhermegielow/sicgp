<?php
class Assuntostratado extends AppModel {

	var $name = 'Assuntostratado';
	var $validate = array(
		'atasreuniao_id' => VALID_NOT_EMPTY,
		'ds_assunto_tratado' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Atasreuniao' =>
				array('className' => 'Atasreuniao',
						'foreignKey' => 'atasreuniao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Assuntostratado"]["id"])){
             $this->data["Assuntostratado"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Assuntostratado"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
