<?php
class Escoposnaoincluido extends AppModel {

	var $name = 'Escoposnaoincluido';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_escopo_nao_incluido' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Escoposnaoincluido"]["id"])){
             $this->data["Escoposnaoincluido"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Escoposnaoincluido"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
