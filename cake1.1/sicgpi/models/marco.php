<?php
class Marco extends AppModel {

	var $name = 'Marco';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_marco' => VALID_NOT_EMPTY,
		'dt_entrega' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Marco"]["id"])){
             $this->data["Marco"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Marco"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
