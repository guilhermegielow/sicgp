<?php
class Tiposmudanca extends AppModel {

	var $name = 'Tiposmudanca';
	var $validate = array(
		'ds_tipo_mudanca' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Controlesmudanca' =>
				array('className' => 'Controlesmudanca',
						'foreignKey' => 'tiposmudanca_id',
						'conditions' => '',
						'fields' => 'id, ds_controle_mudanca',
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
             if (!isset($this->data["Tiposmudanca"]["id"])){
             $this->data["Tiposmudanca"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposmudanca"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
