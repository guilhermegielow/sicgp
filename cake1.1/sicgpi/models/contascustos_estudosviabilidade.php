<?php
class ContascustosEstudosviabilidade extends AppModel {

	var $name = 'ContascustoEstudosviabilidade';
	var $primaryKey = 'contascusto_id, estudosviabilidade_id';
	var $validate = array(
		'contascusto_id' => VALID_NOT_EMPTY,
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Contascusto' =>
				array('className' => 'Contascusto',
						'foreignKey' => 'contascusto_id',
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
