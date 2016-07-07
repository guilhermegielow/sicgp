<?php
class Planosprojeto extends AppModel {

	var $name = 'Planosprojeto';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_plano_projeto' => VALID_NOT_EMPTY,
		'nr_versao' => VALID_NOT_EMPTY,
		'dt_abertura' => VALID_NOT_EMPTY,
		'nm_responsavel' => VALID_NOT_EMPTY,
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
						'joinTable' => 'planosprojetos_usuarios',
						'foreignKey' => 'planosprojeto_id',
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
             if (!isset($this->data["Planosprojeto"]["id"])){
             $this->data["Planosprojeto"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Planosprojeto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
