<?php
class Acao extends AppModel {

	var $name = 'Acao';
	var $validate = array(
		'atasreuniao_id' => VALID_NOT_EMPTY,
		'ds_acao' => VALID_NOT_EMPTY,
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

	var $hasAndBelongsToMany = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'acoes_usuarios',
						'foreignKey' => 'acao_id',
						'associationForeignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => 'id, nm_usuario',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Acao"]["id"])){
             $this->data["Acao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Acao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
