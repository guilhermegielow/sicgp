<?php
class Atividade extends AppModel {

	var $name = 'Atividade';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'cd_atividade_pai' => VALID_NOT_EMPTY,
		'ds_atividade' => VALID_NOT_EMPTY,
		'dias_prazo' => VALID_NOT_EMPTY,
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

	var $hasMany = array(
			'AtividadesEstudosviabilidadesRecurso' =>
				array('className' => 'AtividadesEstudosviabilidadesRecurso',
						'foreignKey' => 'atividade_id',
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

			'Dicionarioseap' =>
				array('className' => 'Dicionarioseap',
						'foreignKey' => 'atividade_id',
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

			'Elementoseap' =>
				array('className' => 'Elementoseap',
						'foreignKey' => 'atividade_id',
						'conditions' => '',
						'fields' => 'id, vl_perc_concluido, vl_planejado, dt_planejada',
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
			'Cronograma' =>
				array('className' => 'Cronograma',
						'joinTable' => 'atividades_cronogramas',
						'foreignKey' => 'atividade_id',
						'associationForeignKey' => 'cronograma_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Orcamento' =>
				array('className' => 'Orcamento',
						'joinTable' => 'atividades_orcamentos',
						'foreignKey' => 'atividade_id',
						'associationForeignKey' => 'orcamento_id',
						'conditions' => '',
						'fields' => 'id',
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
             if (!isset($this->data["Atividade"]["id"])){
             $this->data["Atividade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Atividade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
