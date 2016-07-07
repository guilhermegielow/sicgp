<?php
class Fatorescritico extends AppModel {

	var $name = 'Fatorescritico';
	var $validate = array(
		'licoesaprendida_id' => VALID_NOT_EMPTY,
		'ds_fator_critico' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Atividade"]["id"])){
             $this->data["Fatorescritico"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Fatorescritico"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
