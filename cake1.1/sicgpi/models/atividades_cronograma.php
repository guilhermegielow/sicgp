<?php
class AtividadesCronograma extends AppModel {

	var $name = 'AtividadesCronograma';
	var $primaryKey = 'cronograma_id, atividade_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Cronograma' =>
				array('className' => 'Cronograma',
						'foreignKey' => 'cronograma_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Atividade' =>
				array('className' => 'Atividade',
						'foreignKey' => 'atividade_id',
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

	);

}
?>
