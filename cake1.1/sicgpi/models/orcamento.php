<?php
class Orcamento extends AppModel {

	var $name = 'Orcamento';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
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

	var $hasAndBelongsToMany = array(
			'Atividade' =>
				array('className' => 'Atividade',
						'joinTable' => 'atividades_orcamentos',
						'foreignKey' => 'orcamento_id',
						'associationForeignKey' => 'atividade_id',
						'conditions' => '',
						'fields' => 'id, ds_atividade, vl_custo, dias_prazo, vl_realizado',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Recurso' =>
				array('className' => 'Recurso',
						'joinTable' => 'orcamentos_recursos',
						'foreignKey' => 'orcamento_id',
						'associationForeignKey' => 'recurso_id',
						'conditions' => '',
						'fields' => 'id, ds_recurso, vl_custo, quantidade',
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
             if (!isset($this->data["Orcamento"]["id"])){
                $this->data["Orcamento"]["user_created"] = $_SESSION['Usuario'];
                }
                $this->data["Orcamento"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
    function afterSave(){
             $x = $this->query("SELECT max(id) id from orcamentos");
             $id = $x[0][0]['id'];
             $vl_projeto = $this->query("SELECT sum(atividades.vl_custo) valor_custo from atividades, atividades_orcamentos where atividades_orcamentos.orcamento_id = $id
             and atividades_orcamentos.atividade_id = atividades.id");
             $valor_projeto = $vl_projeto['0']['0']['valor_custo'];
             $vl_total = $this->query("SELECT vl_administracao, vl_reserva from orcamentos where id = $id");
             $valor_total = ($vl_projeto['0']['0']['valor_custo'] + $vl_total['0']['orcamentos']['vl_administracao'] + $vl_total['0']['orcamentos']['vl_reserva']);
             $this->execute("UPDATE orcamentos set vl_projeto = $valor_projeto, vl_total =  $valor_total where id = $id");

    }
    function valorCusto($id){
             $vl_projeto = $this->query("SELECT sum(atividades.vl_custo) valor_custo from atividades, atividades_orcamentos where atividades_orcamentos.orcamento_id = $id
             and atividades_orcamentos.atividade_id = atividades.id");
             $valor_projeto = $vl_projeto['0']['0']['valor_custo'];
             $vl_total = $this->query("SELECT vl_administracao, vl_reserva from orcamentos where id = $id");
             $valor_total = ($vl_projeto['0']['0']['valor_custo'] + $vl_total['0']['orcamentos']['vl_administracao'] + $vl_total['0']['orcamentos']['vl_reserva']);
             $this->execute("UPDATE orcamentos set vl_projeto = $valor_projeto, vl_total =  $valor_total where id = $id");
            }

}
?>
