<?php
class Servico extends AppModel {

	var $name = 'Servico';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_servico' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array(
			'ProdutosServicosTermosaceitesprojeto' =>
				array('className' => 'ProdutosServicosTermosaceitesprojeto',
						'foreignKey' => 'servico_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);

	var $hasAndBelongsToMany = array(
			'Produto' =>
				array('className' => 'Produto',
						'joinTable' => 'produtos_servicos_termosaceitesprojetos',
						'foreignKey' => 'servico_id',
						'associationForeignKey' => 'produto_id',
						'conditions' => '',
						'fields' => 'id, ds_produto',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Servico"]["id"])){
             $this->data["Servico"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Servico"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
