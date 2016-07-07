<?php
class Usuario extends AppModel {

	var $name = 'Usuario';
	var $validate = array(
		'departamento_id' => VALID_NOT_EMPTY,
		'ds_usuario' => VALID_NOT_EMPTY,
		'ds_senha' => VALID_NOT_EMPTY,
		'nm_usuario' => VALID_NOT_EMPTY,
		'ds_email' => VALID_EMAIL,
		'dt_criacao' => VALID_NOT_EMPTY,
		'dt_alt_senha' => VALID_NOT_EMPTY,
		'prazo_senha' => VALID_NOT_EMPTY,
		'dt_fim_usuario' => VALID_NOT_EMPTY,
		'nr_telefone' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Departamento' =>
				array('className' => 'Departamento',
						'foreignKey' => 'departamento_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array(
			'Historico' =>
				array('className' => 'Historico',
						'foreignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => 'id, ds_historico',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),	

	);

	var $hasAndBelongsToMany = array( // a classe Acao pode ter e
			'Acao' =>                 // pertencer a muitas classes Usuario
				array('className' => 'Acao',
						'joinTable' => 'acoes_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'acao_id',
						'conditions' => '',
						'fields' => 'id, ds_acao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Acoesrelatorio' =>
				array('className' => 'Acoesrelatorio',
						'joinTable' => 'acoesrelatorios_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'acoesrelatorio_id',
						'conditions' => '',
						'fields' => 'id, ds_acao_relatorio',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'joinTable' => 'declaracoesescopos_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_declaracao_escopo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Dicionarioseap' =>
				array('className' => 'Dicionarioseap',
						'joinTable' => 'dicionarioseaps_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'dicionarioseap_id',
						'conditions' => '',
						'fields' => 'id, ds_descricao_eap',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'joinTable' => 'estudosviabilidades_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),


			'Mapascomunicacao' =>
				array('className' => 'Mapascomunicacao',
						'joinTable' => 'mapascomunicacoes_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'mapascomunicacao_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Planosprojeto' =>
				array('className' => 'Planosprojeto',
						'joinTable' => 'planosprojetos_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'planosprojeto_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Termosaceitesprojeto' =>
				array('className' => 'Termosaceitesprojeto',
						'joinTable' => 'termosaceitesprojetos_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'termosaceitesprojeto_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	function retornaLeft($usuario){
             $ret = $this->query("SELECT lft FROM aros
                                 WHERE alias = '$usuario'");
             $l = $ret[0]['aros']['lft'];
             return $l;
    }
	function retornaGrupo($nr){
             $ret = $this->query("SELECT foreign_key FROM aros
                                 WHERE lft < '$nr' and rght > '$nr' and foreign_key < 100");
             $grp = $ret[0]['aros']['foreign_key'];
             return $grp;
    }
	function beforeSave(){ // antes de salvar os dados
             if (!isset($this->data["Usuario"]["id"])){
             $this->data["Usuario"]["user_created"] = $_SESSION['Usuario']; //usuario logado
             }
             $this->data["Usuario"]["user_modified"] = $_SESSION['Usuario']; //usuario logado
             return true;
    }
 }
?>
