<?php
class Recurso extends AppModel {

	var $name = 'Recurso';
	var $validate = array(
		'gruposrecurso_id' => VALID_NOT_EMPTY,
		'unidade_id' => VALID_NOT_EMPTY,
		'ds_recurso' => VALID_NOT_EMPTY,
		'vl_custo' => VALID_NOT_EMPTY,
		'quantidade' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Gruposrecurso' =>
				array('className' => 'Gruposrecurso',
						'foreignKey' => 'gruposrecurso_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Unidade' =>
				array('className' => 'Unidade',
						'foreignKey' => 'unidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
	);

	var $hasMany = array(
			'AtividadesEstudosviabilidadesRecurso' =>
				array('className' => 'AtividadesEstudosviabilidadesRecurso',
						'foreignKey' => 'recurso_id',
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

	var $hasAndBelongsToMany = array(
			'Orcamento' =>
				array('className' => 'Orcamento',
						'joinTable' => 'orcamentos_recursos',
						'foreignKey' => 'recurso_id',
						'associationForeignKey' => 'orcamento_id',
						'conditions' => '',
						'fields' => 'id, vl_projeto, vl_reserva, vl_administracao, vl_total',
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
             if (!isset($this->data["Recurso"]["id"])){
             $this->data["Recurso"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Recurso"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
