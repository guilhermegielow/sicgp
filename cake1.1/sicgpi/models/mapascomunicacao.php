<?php
class Mapascomunicacao extends AppModel {

	var $name = 'Mapascomunicacao';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_assunto' => VALID_NOT_EMPTY,
		'tp_documento' => VALID_NOT_EMPTY,
		'tp_meio' => VALID_NOT_EMPTY,
		'dias_frequencia' => VALID_NOT_EMPTY,
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

	var $hasAndBelongsToMany = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'mapascomunicacoes_usuarios',
						'foreignKey' => 'mapascomunicacao_id',
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
             if (!isset($this->data["Mapascomunicacao"]["id"])){
             $this->data["Mapascomunicacao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Mapascomunicacao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
