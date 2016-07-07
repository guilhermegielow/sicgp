<?php
class Estado extends AppModel {

	var $name = 'Estado';
	var $validate = array(
		'ds_estado' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'estado_id',
						'conditions' => '',
						'fields' => 'id, ds_titulo, dt_prazo',
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
             if (!isset($this->data["Estado"]["id"])){
             $this->data["Estado"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Estado"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
