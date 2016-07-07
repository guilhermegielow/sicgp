<?php
class Produto extends AppModel {

	var $name = 'Produto';
	var $validate = array(
		'estudosviabilidade_id' => VALID_NOT_EMPTY,
		'ds_produto' => VALID_NOT_EMPTY,
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
						'foreignKey' => 'produto_id',
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
	function beforeSave(){
             if (!isset($this->data["Produto"]["id"])){
             $this->data["Produto"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Produto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
