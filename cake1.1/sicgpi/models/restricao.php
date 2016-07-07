<?php
class Restricao extends AppModel {

	var $name = 'Restricao';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_restricao' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Restricao"]["id"])){
             $this->data["Restricao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Restricao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
