<?php
class Tiposatividade extends AppModel {

	var $name = 'Tiposatividade';
	var $validate = array(
		'ds_tipo_atividades' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'AcoesUsuario' =>
				array('className' => 'AcoesUsuario',
						'foreignKey' => 'tiposatividade_id',
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
             if (!isset($this->data["Tiposatividade"]["id"])){
             $this->data["Tiposatividade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposatividade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
