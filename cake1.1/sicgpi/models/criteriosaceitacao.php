<?php
class Criteriosaceitacao extends AppModel {

	var $name = 'Criteriosaceitacao';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_criterio_aceitacao' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Criteriosaceitacao"]["id"])){
             $this->data["Criteriosaceitacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Criteriosaceitacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
