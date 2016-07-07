<?php
class Restricoesescopo extends AppModel {

	var $name = 'Restricoesescopo';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_restricao_escopo' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Restricoesescopo"]["id"])){
             $this->data["Restricoesescopo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Restricoesescopo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
