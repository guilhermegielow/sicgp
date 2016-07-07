<?php
class AtividadesOrcamento extends AppModel {

	var $name = 'AtividadesOrcamento';
	var $primaryKey = 'orcamento_id, atividade_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Orcamento' =>
				array('className' => 'Orcamento',
						'foreignKey' => 'orcamento_id',
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

	);

}
?>