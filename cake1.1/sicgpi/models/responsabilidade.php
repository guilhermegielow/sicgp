<?php
class Responsabilidade extends AppModel {

	var $name = 'Responsabilidade';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'tiposresponsabilidade_id' => VALID_NOT_EMPTY,
		'ds_responsabilidade' => VALID_NOT_EMPTY,
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

			'Tiposresponsabilidade' =>
				array('className' => 'Tiposresponsabilidade',
						'foreignKey' => 'tiposresponsabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Responsabilidade"]["id"])){
             $this->data["Responsabilidade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Responsabilidade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
