<?php
class AcoesUsuario extends AppModel {

	var $name = 'AcoesUsuario';
	var $primaryKey = 'usuario_id, acao_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'foreignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Acao' =>
				array('className' => 'Acao',
						'foreignKey' => 'acao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Tiposatividade' =>
				array('className' => 'Tiposatividade',
						'foreignKey' => 'tiposatividade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>