<?php
class Servicosescopo extends AppModel {

	var $name = 'Servicosescopo';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_servico_escopo' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Servicosescopo"]["id"])){
             $this->data["Servicosescopo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Servicosescopo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
