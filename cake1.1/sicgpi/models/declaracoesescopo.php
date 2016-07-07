<?php
class Declaracoesescopo extends AppModel {

	var $name = 'Declaracoesescopo';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_declaracao_escopo' => VALID_NOT_EMPTY,
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
			'Criteriosaceitacao' =>
				array('className' => 'Criteriosaceitacao',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_criterio_aceitacao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Escoposnaoincluido' =>
				array('className' => 'Escoposnaoincluido',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_escopo_nao_incluido',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Estrategiasconducao' =>
				array('className' => 'Estrategiasconducao',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_estrategia_conducao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Objetivosescopo' =>
				array('className' => 'Objetivosescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_objetivo_escopo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Premissa' =>
				array('className' => 'Premissa',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_premissa',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Produtosescopo' =>
				array('className' => 'Produtosescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_produto_escopo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Restricoesescopo' =>
				array('className' => 'Restricoesescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_restricao_escopo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Servicosescopo' =>
				array('className' => 'Servicosescopo',
						'foreignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_servico_escopo',
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
			'Departamento' =>
				array('className' => 'Departamento',
						'joinTable' => 'declaracoesescopos_departamentos',
						'foreignKey' => 'declaracoesescopo_id',
						'associationForeignKey' => 'departamento_id',
						'conditions' => '',
						'fields' => 'id, ds_departamento',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'declaracoesescopos_usuarios',
						'foreignKey' => 'declaracoesescopo_id',
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
             if (!isset($this->data["Declaracoesescopo"]["id"])){
             $this->data["Declaracoesescopo"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Declaracoesescopo"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
