<?php
class Justificativa extends AppModel {

	var $name = 'Justificativa';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_justificativa' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Justificativa"]["id"])){
             $this->data["Justificativa"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Justificativa"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
