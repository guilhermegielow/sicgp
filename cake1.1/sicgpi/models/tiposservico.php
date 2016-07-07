<?php
class Tiposservico extends AppModel {

	var $name = 'Tiposservico';
	var $validate = array(
		'ds_tipo_servico' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'tiposservico_id',
						'conditions' => '',
						'fields' => 'id, dt_inicio_validade, dt_fim_validade, ds_texto_encerramento',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Tiposservico"]["id"])){
             $this->data["Tiposservico"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Tiposservico"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
