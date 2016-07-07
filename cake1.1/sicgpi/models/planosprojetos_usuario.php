<?php
class PlanosprojetosUsuario extends AppModel {

	var $name = 'PlanosprojetosUsuario';
	var $primaryKey = 'usuario_id, planosprojeto_id';
	var $validate = array(
		'usuario_id' => VALID_NOT_EMPTY,
		'planosprojeto_id' => VALID_NOT_EMPTY,
	);

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

			'Planosprojeto' =>
				array('className' => 'Planosprojeto',
						'foreignKey' => 'planosprojeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>