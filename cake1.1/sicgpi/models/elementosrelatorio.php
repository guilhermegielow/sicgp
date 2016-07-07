<?php
class Elementosrelatorio extends AppModel {

	var $name = 'Elementosrelatorio';
	var $validate = array(
		'relatoriosdesempenho_id' => VALID_NOT_EMPTY,
		'ds_atividade' => VALID_NOT_EMPTY,
		'vl_perc_concluido' => VALID_NOT_EMPTY,
		'dt_planejada' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Relatoriosdesempenho' =>
				array('className' => 'Relatoriosdesempenho',
						'foreignKey' => 'relatoriosdesempenho_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Elementosrelatorio"]["id"])){
             $this->data["Elementosrelatorio"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Elementosrelatorio"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
