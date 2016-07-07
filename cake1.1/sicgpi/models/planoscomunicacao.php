<?php
class Planoscomunicacao extends AppModel {

	var $name = 'Planoscomunicacao';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_plano_comunicacao' => VALID_NOT_EMPTY,
		'ds_politicas' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	function beforeSave(){
             if (!isset($this->data["Planoscomunicacao"]["id"])){
             $this->data["Planoscomunicacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Planoscomunicacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
