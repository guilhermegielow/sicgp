<?php
class AcoesrelatoriosUsuario extends AppModel {

	var $name = 'AcoesrelatoriosUsuario';
	var $primaryKey = 'acoesrelatorio_id, usuario_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Acoesrelatorio' =>
				array('className' => 'Acoesrelatorio',
						'foreignKey' => 'acoesrelatorio_id',
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