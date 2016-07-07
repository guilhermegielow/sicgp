<?php
class DeclaracoesescoposUsuario extends AppModel {

	var $name = 'DeclaracoesescoposUsuario';
	var $primaryKey = 'usuario_id, declaracoesescopo_id';

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

			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>