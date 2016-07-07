<?php
class TermosaceitesprojetosUsuario extends AppModel {

	var $name = 'TermosaceitesprojetosUsuario';
	var $primaryKey = 'usuario_id, termosaceiteprojeto_id';

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

			'Termosaceitesprojeto' =>
				array('className' => 'Termosaceitesprojeto',
						'foreignKey' => 'termosaceitesprojeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>