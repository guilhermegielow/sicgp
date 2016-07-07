<?php
class Fornecedor extends AppModel {

	var $name = 'Fornecedor';
	var $validate = array(
		'nm_fornecedor' => VALID_NOT_EMPTY,
		'nr_cnpj' => VALID_NOT_EMPTY,
		'nr_telefone' => VALID_NOT_EMPTY,
		'nm_contato' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Processosaquisicao' =>
				array('className' => 'Processosaquisicao',
						'foreignKey' => 'fornecedor_id',
						'conditions' => '',
						'fields' => 'id, ds_processo_aquisicao, vl_orcamento, dias_prazo',
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
             if (!isset($this->data["Fornecedor"]["id"])){
             $this->data["Fornecedor"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Fornecedor"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
