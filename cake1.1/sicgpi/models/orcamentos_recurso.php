<?php
class OrcamentosRecurso extends AppModel {

	var $name = 'OrcamentosRecurso';
	var $primaryKey = 'recurso_id, orcamento_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Recurso' =>
				array('className' => 'Recurso',
						'foreignKey' => 'recurso_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Orcamento' =>
				array('className' => 'Orcamento',
						'foreignKey' => 'orcamento_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>