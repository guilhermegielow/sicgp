<?php
class Tiposresponsabilidade extends AppModel {

	var $name = 'Tiposresponsabilidade';
	var $validate = array(
		'ds_tipo_responsabilidade' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Responsabilidade' =>
				array('className' => 'Responsabilidade',
						'foreignKey' => 'tiposresponsabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_responsabilidade',
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
             if (!isset($this->data["Tiposresponsabilidade"]["id"])){
             $this->data["Tiposresponsabilidade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposresponsabilidade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
