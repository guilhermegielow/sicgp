<?php
class Recomendacao extends AppModel {

	var $name = 'Recomendacao';
	var $validate = array(
		'licoesaprendida_id' => VALID_NOT_EMPTY,
		'ds_recomendacao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Licoesaprendida' =>
				array('className' => 'Licoesaprendida',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Recomendacao"]["id"])){
             $this->data["Recomendacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Recomendacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
