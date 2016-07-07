<?php
class Produtosescopo extends AppModel {

	var $name = 'Produtosescopo';
	var $validate = array(
		'declaracoesescopo_id' => VALID_NOT_EMPTY,
		'ds_produto_escopo' => VALID_NOT_EMPTY,
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
             if (!isset($this->data["Produtosescopo"]["id"])){
             $this->data["Produtosescopo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Produtosescopo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
