<?php
class Planoscusto extends AppModel {

	var $name = 'Planoscusto';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_plano_custo' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Planoscusto"]["id"])){
             $this->data["Planoscusto"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Planoscusto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
