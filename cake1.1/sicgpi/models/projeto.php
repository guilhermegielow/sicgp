<?php
class Projeto extends AppModel {

	var $name = 'Projeto';
	var $validate = array(
		'estado_id' => VALID_NOT_EMPTY, // campos consistidos pela tela
		'ds_titulo' => VALID_NOT_EMPTY, // campos consistidos pela tela
		'dt_abertura' => VALID_NOT_EMPTY, // campos consistidos pela tela
		'dt_prazo' => VALID_NOT_EMPTY,  // campos consistidos pela tela
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array( //pertence a classe Estado
			'Estado' =>
				array('className' => 'Estado',
						'foreignKey' => 'estado_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			'Usuario' =>
				array('className' => 'Usuario',
						'foreignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array( // possui nenhuma ou mais classes Anexo
			'Anexo' =>
				array('className' => 'Anexo',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_anexo, arq_anexo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Atasreuniao' =>
				array('className' => 'Atasreuniao',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_ata_reuniao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Atividade' =>
				array('className' => 'Atividade',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_atividade, vl_custo, dias_prazo, vl_realizado',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Controlesmudanca' =>
				array('className' => 'Controlesmudanca',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_controle_mudanca, ds_justificativa, dt_prazo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Cronograma' =>
				array('className' => 'Cronograma',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_declaracao_escopo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Dicionarioseap' =>
				array('className' => 'Dicionarioseap',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_descricao_eap',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, dt_inicio_validade, dt_fim_validade, ds_texto_encerramento',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Historico' =>
				array('className' => 'Historico',
						'foreignKey' => 'projeto_id',
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

			'Licoesaprendida' =>
				array('className' => 'Licoesaprendida',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_licao_aprendida',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Mensagem' =>
				array('className' => 'Mensagem',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_mensagem, nm_envolvidos',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Orcamento' =>
				array('className' => 'Orcamento',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, vl_projeto, vl_reserva, vl_administracao, vl_total',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Passosworkflow' =>
				array('className' => 'Passosworkflow',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, nr_passo, ds_passo, user_responsavel',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Planosaquisicao' =>
				array('className' => 'Planosaquisicao',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_plano_aquisicao, ds_documento_referencia, ds_avaliacao_fornecedores',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Planoscomunicacao' =>
				array('className' => 'Planoscomunicacao',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_plano_comunicacao, ds_politicas',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Planoscusto' =>
				array('className' => 'Planoscusto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_plano_custo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Planosprojeto' =>
				array('className' => 'Planosprojeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_plano_projeto',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
			'Recurso' =>
				array('className' => 'Recurso',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_recurso, vl_custo, quantidade',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Relatoriosdesempenho' =>
				array('className' => 'Relatoriosdesempenho',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, ds_relatorio_desempenho',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Termosaceitesprojeto' =>
				array('className' => 'Termosaceitesprojeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => 'id, dt_aceite, ds_local, ds_resumo_projeto',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	function tempoCusto($id)
    {
     $x = $this->query("SELECT d.ds_departamento, sum(a.vl_custo) vl_custo, sum(a.dias_prazo) dias_prazo FROM atividades a, elementoseaps e, departamentos d, usuarios u
          WHERE a.projeto_id = $id and a.id = e.atividade_id and u.ds_usuario = e.user_responsavel and u.departamento_id = d.id
          GROUP BY d.ds_departamento
          ORDER BY d.ds_departamento");
     return $x;
    }
	function beforeSave(){
             if (!isset($this->data["Projeto"]["id"])){
                $this->data["Projeto"]["user_created"] = $_SESSION['Usuario'];
                // pega o ultimo projeto
                $ret = $this->query("SELECT max(p.id) id from projetos p, passosworkflows pw where pw.projeto_id = p.id");
                $p = $ret[0][0]['id'];
                // copia todos os dados do projeto anterior
                $x = $this->query("SELECT projeto_id + 1 projeto, nr_passo, ds_passo, user_responsavel, mensagem_inicial,
                mensagem_expirada, nr_passo_aprovado, hr_expiracao
                from passosworkflows where projeto_id = '$p'");
                for ($i = 0; $i < sizeof($x); $i++){
                     $usuario = $this->data["Projeto"]["usuario_id"];
                     $pat = $this->query("SELECT ds_usuario from usuarios where id = $usuario");
                     $patrocinador = $pat[0]['usuarios']['ds_usuario'];
                     $gerente = $_SESSION['Usuario'];
                     $projeto = $x[$i]['0']['projeto'];
                     $nr_passo = $x[$i]['passosworkflows']['nr_passo'];
                     $ds_passo = $x[$i]['passosworkflows']['ds_passo'];
                     $user_responsavel = $x[$i]['passosworkflows']['user_responsavel'];
                     $mensagem_inicial = $x[$i]['passosworkflows']['mensagem_inicial'];
                     $mensagem_expirada = $x[$i]['passosworkflows']['mensagem_expirada'];
                     $nr_passo_aprovado = $x[$i]['passosworkflows']['nr_passo_aprovado'];
                     $hr_expiracao = $x[$i]['passosworkflows']['hr_expiracao'];
                    //copia o passo do analista contabil igual ao projeto anterior
                    if ($x[$i]['passosworkflows']['nr_passo'] == 1) {
                       $this->execute("INSERT INTO passosworkflows (projeto_id, nr_passo, ds_passo, user_responsavel, mensagem_inicial,
                       mensagem_expirada, nr_passo_aprovado,  hr_expiracao)
                       VALUES ($projeto, $nr_passo, '$ds_passo', '$user_responsavel', '$mensagem_inicial', '$mensagem_expirada',
                       $nr_passo_aprovado, $hr_expiracao)");
                    }
                    // copia os passos do patrocinador e coloca o atual
                    else if ($x[$i]['passosworkflows']['nr_passo'] == 3 || $x[$i]['passosworkflows']['nr_passo'] == 5 ||
                    $x[$i]['passosworkflows']['nr_passo'] == 7 || $x[$i]['passosworkflows']['nr_passo'] == 9)
                     { $this->execute("INSERT INTO passosworkflows (projeto_id, nr_passo, ds_passo, user_responsavel, mensagem_inicial,
                       mensagem_expirada, nr_passo_aprovado, hr_expiracao)
                       VALUES ($projeto, $nr_passo, '$ds_passo', '$patrocinador', '$mensagem_inicial', '$mensagem_expirada',
                       $nr_passo_aprovado, $hr_expiracao)");
                     }

                    // copia os passos do gerente e coloca o atual
                    else
                    { $this->execute("INSERT INTO passosworkflows (projeto_id, nr_passo, ds_passo, user_responsavel, mensagem_inicial,
                       mensagem_expirada, nr_passo_aprovado,hr_expiracao)
                       VALUES ($projeto, $nr_passo, '$ds_passo', '$gerente', '$mensagem_inicial', '$mensagem_expirada',
                       $nr_passo_aprovado, $hr_expiracao)");
                     }
              }
             }
             $this->data["Projeto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
  }
}
?>
