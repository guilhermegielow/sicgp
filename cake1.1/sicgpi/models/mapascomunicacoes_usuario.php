<?php
class MapascomunicacoesUsuario extends AppModel {

	var $name = 'MapascomunicacoesUsuario';
	var $primaryKey = 'usuario_id, mapascomunicacao_id';

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

			'Mapascomunicacao' =>
				array('className' => 'Mapascomunicacao',
						'foreignKey' => 'mapascomunicacao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Tiposcomunicacao' =>
				array('className' => 'Tiposcomunicacao',
						'foreignKey' => 'tiposcomunicacao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>