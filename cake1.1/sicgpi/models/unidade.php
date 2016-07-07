<?php
class Unidade extends AppModel {

	var $name = 'Unidade';
	var $validate = array(
		'ds_unidade' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'AtividadesCronograma' =>
				array('className' => 'AtividadesCronograma',
						'foreignKey' => 'unidade_id',
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

			'Recurso' =>
				array('className' => 'Recurso',
						'foreignKey' => 'unidade_id',
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
             if (!isset($this->data["Atividade"]["id"])){
             $this->data["Unidade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Unidade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
