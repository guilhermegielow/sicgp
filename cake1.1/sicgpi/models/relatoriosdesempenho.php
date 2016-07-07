<?php
class Relatoriosdesempenho extends AppModel {

	var $name = 'Relatoriosdesempenho';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'dt_relatorio' => VALID_NOT_EMPTY,
		'ds_relatorio_desempenho' => VALID_NOT_EMPTY,
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
			'Acoesrelatorio' =>
				array('className' => 'Acoesrelatorio',
						'foreignKey' => 'relatoriosdesempenho_id',
						'conditions' => '',
						'fields' => 'id, ds_acao_relatorio',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Elementosrelatorio' =>
				array('className' => 'Elementosrelatorio',
						'foreignKey' => 'relatoriosdesempenho_id',
						'conditions' => '',
						'fields' => 'id, ds_atividade, vl_perc_concluido, dt_planejada',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
    function gravaElementos($projeto_id, $rel_id){
             $atividadesEmAtraso = 0;
             // selecionar os registros dos elementos eaps deste projeto
             $dadoseaps = $this->query("SELECT elementoseaps.atividade_id, elementoseaps.vl_planejado, elementoseaps.vl_real, elementoseaps.vl_perc_concluido,
             elementoseaps.dt_planejada, elementoseaps.dt_efetiva, elementoseaps.dias_atraso, elementoseaps.user_solicitante, elementoseaps.user_responsavel,
             elementoseaps.user_created, elementoseaps.user_modified, atividades.ds_atividade, atividades.id FROM elementoseaps, atividades
             WHERE elementoseaps.atividade_id = atividades.id and atividades.projeto_id = $projeto_id and elementoseaps.vl_perc_concluido < 100");
             // le os registros que selecionou para inserir no relatorio de desempenho
             for ($i = 0; $i < sizeof($dadoseaps); $i++) {
                 $ds_atividade = $dadoseaps[$i]['atividades']['ds_atividade'];
                 $vl_planejado = $dadoseaps[$i]['elementoseaps']['vl_planejado'];
                 $vl_real = $dadoseaps[$i]['elementoseaps']['vl_real'];
                 $vl_perc_concluido = $dadoseaps[$i]['elementoseaps']['vl_perc_concluido'];
                 $dt_planejada = $dadoseaps[$i]['elementoseaps']['dt_planejada'];
                 $dt_efetiva = $dadoseaps[$i]['elementoseaps']['dt_efetiva'];
                 $dias_atraso = $dadoseaps[$i]['elementoseaps']['dias_atraso'];
                 $user_solicitante = $dadoseaps[$i]['elementoseaps']['user_solicitante'];
                 $user_responsavel = $dadoseaps[$i]['elementoseaps']['user_responsavel'];
                 $user_created = $dadoseaps[$i]['elementoseaps']['user_created'];
                 $user_modified = $dadoseaps[$i]['elementoseaps']['user_modified'];
                 // copiar as informações dos elementos Eaps e colar nos elementos do relatório
                 $this->execute("INSERT INTO elementosrelatorios (relatoriosdesempenho_id, ds_atividade, vl_planejado, vl_real, vl_perc_concluido,
                 dt_planejada, dt_efetiva, dias_atraso, user_solicitante, user_responsavel, user_created, user_modified, created, modified)
                 VALUES ($rel_id, '$ds_atividade', $vl_planejado, $vl_real, $vl_perc_concluido, $dt_planejada, $dt_efetiva, $dias_atraso,
                 '$user_solicitante', '$user_responsavel', '$user_created', '$user_modified', NOW(), NOW())");
                 // acumula atividades em atraso
                 if ($dt_planejada < (date('d/m/y'))){
                    $atividadesEmAtraso++;
                 }
                 }
             // envia mensagem dos dados gerenciais dos elementos eaps em atraso
             $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id,
             'O relatoório id = $rel_id possui $atividadesEmAtraso elementos eaps em atraso', NOW(), '$user_created')");
             }
             
    function beforeSave(){
             if (!isset($this->data["Relatoriosdesempenho"]["id"])){
             $this->data["Relatoriosdesempenho"]["user_created"] = $_SESSION['Usuario'];
             }

             $this->data["Relatoriosdesempenho"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
    
}
?>
