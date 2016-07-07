<?php
class Alteracao extends AppModel {

	var $name = 'Alteracao';
	var $validate = array(
		'planosprojeto_id' => VALID_NOT_EMPTY,
		'ds_alteracao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
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