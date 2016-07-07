<?php
class Decisao extends AppModel {

	var $name = 'Decisao';
	var $validate = array(
		'atasreuniao_id' => VALID_NOT_EMPTY,
		'ds_decisao' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Decisao"]["id"])){
             $this->data["Decisao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Decisao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
