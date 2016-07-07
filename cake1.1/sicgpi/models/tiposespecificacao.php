<?php
class Tiposespecificacao extends AppModel {

	var $name = 'Tiposespecificacao';
	var $validate = array(
		'ds_tipo_especificacao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Dicionarioseap' =>
				array('className' => 'Dicionarioseap',
						'foreignKey' => 'tiposespecificacao_id',
						'conditions' => '',
						'fields' => 'id, ds_descricao_eap',
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
             if (!isset($this->data["Tiposespecificacao"]["id"])){
             $this->data["Tiposespecificacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposespecificacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
