<?php
class Historico extends AppModel {

	var $name = 'Historico';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'usuario_id' => VALID_NOT_EMPTY,
		'ds_historico' => VALID_NOT_EMPTY,
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

			'Usuario' =>
				array('className' => 'Usuario',
						'foreignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>