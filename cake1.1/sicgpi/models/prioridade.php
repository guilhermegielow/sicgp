<?php
class Prioridade extends AppModel {

	var $name = 'Prioridade';
	var $validate = array(
		'ds_prioridade' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Controlesmudanca' =>
				array('className' => 'Controlesmudanca',
						'foreignKey' => 'prioridade_id',
						'conditions' => '',
						'fields' => 'id, ds_controle_mudanca, ds_justificativa',
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
             if (!isset($this->data["Prioridade"]["id"])){
             $this->data["Prioridade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Prioridade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
