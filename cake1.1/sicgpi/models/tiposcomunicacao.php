<?php
class Tiposcomunicacao extends AppModel {

	var $name = 'Tiposcomunicacao';
	var $validate = array(
		'ds_tipo_comunicacao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'MapascomunicacoesUsuario' =>
				array('className' => 'MapascomunicacoesUsuario',
						'foreignKey' => 'tiposcomunicacao_id',
						'conditions' => '',
						'fields' => '',
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
             if (!isset($this->data["Tiposcomunicacao"]["id"])){
             $this->data["Tiposcomunicacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposcomunicacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
