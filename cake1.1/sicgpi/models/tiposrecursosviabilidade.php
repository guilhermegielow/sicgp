<?php
class Tiposrecursosviabilidade extends AppModel {

	var $name = 'Tiposrecursosviabilidade';
	var $validate = array(
		'ds_tipo_recurso_viabilidade' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'AtividadesEstudosviabilidadesRecurso' =>
				array('className' => 'AtividadesEstudosviabilidadesRecurso',
						'foreignKey' => 'tiposrecursosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Tiposrecursosviabilidade"]["id"])){
             $this->data["Tiposrecursosviabilidade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposrecursosviabilidade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
