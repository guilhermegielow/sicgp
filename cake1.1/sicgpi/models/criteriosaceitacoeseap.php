<?php
class Criteriosaceitacoeseap extends AppModel {

	var $name = 'Criteriosaceitacoeseap';
	var $validate = array(
		'dicionarioseap_id' => VALID_NOT_EMPTY,
		'ds_criterio_aceitacao_eap' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
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