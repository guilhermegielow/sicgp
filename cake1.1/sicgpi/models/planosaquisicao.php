<?php
class Planosaquisicao extends AppModel {

	var $name = 'Planosaquisicao';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_plano_aquisicao' => VALID_NOT_EMPTY,
		'nm_responsavel_plano' => VALID_NOT_EMPTY,
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

	var $hasMany = array(
			'Processosaquisicao' =>
				array('className' => 'Processosaquisicao',
						'foreignKey' => 'planosaquisicao_id',
						'conditions' => '',
						'fields' => 'id, ds_processo_aquisicao, vl_orcamento, dias_prazo, ',
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
             if (!isset($this->data["Planosaquisicao"]["id"])){
             $this->data["Planosaquisicao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Planosaquisicao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
