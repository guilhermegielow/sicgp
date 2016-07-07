<?php
class Acoesrelatorio extends AppModel {

	var $name = 'Acoesrelatorio';
	var $validate = array(
		'relatoriosdesempenho_id' => VALID_NOT_EMPTY,
		'ds_acao_relatorio' => VALID_NOT_EMPTY,
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

	var $hasAndBelongsToMany = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'acoesrelatorios_usuarios',
						'foreignKey' => 'acoesrelatorio_id',
						'associationForeignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => 'id, nm_usuario',
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
             if (!isset($this->data["Acoesrelatorio"]["id"])){
             $this->data["Acoesrelatorio"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Acoesrelatorio"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
