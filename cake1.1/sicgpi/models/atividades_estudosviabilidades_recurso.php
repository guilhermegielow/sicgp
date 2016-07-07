<?php
class AtividadesEstudosviabilidadesRecurso extends AppModel {

	var $name = 'AtividadesEstudosviabilidadesRecurso';
	var $primaryKey = 'id';

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

			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'estudosviabilidade_id',
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

			'Tiposrecursosviabilidade' =>
				array('className' => 'Tiposrecursosviabilidade',
						'foreignKey' => 'tiposrecursosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>
