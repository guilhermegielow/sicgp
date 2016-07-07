<?php
class Gruposrecurso extends AppModel {

	var $name = 'Gruposrecurso';
	var $validate = array(
		'id' => VALID_NOT_EMPTY,
		'ds_grupo_recurso' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Recurso' =>
				array('className' => 'Recurso',
						'foreignKey' => 'gruposrecurso_id',
						'conditions' => '',
						'fields' => 'id, ds_recurso, vl_custo, quantidade',
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
             if (!isset($this->data["Gruposrecurso"]["id"])){
             $this->data["Gruposrecurso"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Gruposrecurso"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
