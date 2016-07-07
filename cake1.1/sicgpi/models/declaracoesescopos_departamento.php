<?php
class DeclaracoesescoposDepartamento extends AppModel {

	var $name = 'DeclaracoesescoposDepartamento';
	var $primaryKey = 'departamento_id, declaracoesescopo_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Departamento' =>
				array('className' => 'Departamento',
						'foreignKey' => 'departamento_id',
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