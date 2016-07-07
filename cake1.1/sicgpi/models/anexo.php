<?php
class Anexo extends AppModel {

	var $name = 'Anexo';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_anexo' => VALID_NOT_EMPTY,
		'arq_anexo' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Anexo"]["id"])){
             $this->data["Anexo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Anexo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
