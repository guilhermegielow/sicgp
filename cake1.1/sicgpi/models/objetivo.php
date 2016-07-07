<?php
class Objetivo extends AppModel {

	var $name = 'Objetivo';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_objetivo' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Objetivo"]["id"])){
             $this->data["Objetivo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Objetivo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
