<?php
class Estrategiasconducao extends AppModel {

	var $name = 'Estrategiasconducao';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_estrategia_conducao' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Estrategiasconducao"]["id"])){
             $this->data["Estrategiasconducao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Estrategiasconducao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
