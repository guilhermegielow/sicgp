<?php
class Tiposreuniao extends AppModel {

	var $name = 'Tiposreuniao';
	var $validate = array(
		'ds_tipo_reuniao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Atasreuniao' =>
				array('className' => 'Atasreuniao',
						'foreignKey' => 'tiposreuniao_id',
						'conditions' => '',
						'fields' => 'id, ds_ata_reuniao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Tiposreuniao"]["id"])){
             $this->data["Tiposreuniao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposreuniao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
