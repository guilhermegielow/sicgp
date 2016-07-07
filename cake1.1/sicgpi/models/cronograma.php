<?php
class Cronograma extends AppModel {

	var $name = 'Cronograma';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
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
			'Atividade' =>
				array('className' => 'Atividade',
						'joinTable' => 'atividades_cronogramas',
						'foreignKey' => 'cronograma_id',
						'associationForeignKey' => 'atividade_id',
						'conditions' => '',
						'fields' => 'id, ds_atividade, vl_custo, dias_prazo, vl_realizado',
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
             if (!isset($this->data["Cronograma"]["id"])){
             $this->data["Cronograma"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Cronograma"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
