<?php
class DicionarioseapsUsuario extends AppModel {

	var $name = 'DicionarioseapsUsuario';
	var $primaryKey = 'usuario_id, dicionarioseap_id';

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

			'Dicionarioseap' =>
				array('className' => 'Dicionarioseap',
						'foreignKey' => 'dicionarioseap_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>