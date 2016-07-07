<?php
class EstudosviabilidadesUsuario extends AppModel {

	var $name = 'EstudosviabilidadesUsuario';
	var $primaryKey = 'usuario_id, estudosviabilidade_id';

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

			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>