<?php
class Tiposconta extends AppModel {

	var $name = 'Tiposconta';
	var $validate = array(
		'ds_tipo_conta' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Contascusto' =>
				array('className' => 'Contascusto',
						'foreignKey' => 'tiposconta_id',
						'conditions' => '',
						'fields' => 'id, ds_contacusto, vl_conta',
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
             if (!isset($this->data["Tiposconta"]["id"])){
             $this->data["Tiposconta"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposconta"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
