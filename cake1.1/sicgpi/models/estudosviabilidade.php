<?php
class Estudosviabilidade extends AppModel {

	var $name = 'Estudosviabilidade';
	var $validate = array(
		'tiposservico_id' => VALID_NOT_EMPTY,
		'projeto_id' => VALID_NOT_EMPTY,
		'dt_inicio_validade' => VALID_NOT_EMPTY,
		'dt_fim_validade' => VALID_NOT_EMPTY,
		'ds_texto_encerramento' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Tiposservico' =>
				array('className' => 'Tiposservico',
						'foreignKey' => 'tiposservico_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

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
			'AtividadesEstudosviabilidadesRecurso' =>
				array('className' => 'AtividadesEstudosviabilidadesRecurso',
						'foreignKey' => 'estudosviabilidade_id',
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

			'Justificativa' =>
				array('className' => 'Justificativa',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_justificativa',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Marco' =>
				array('className' => 'Marco',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_marco, dt_entrega',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Objetivo' =>
				array('className' => 'Objetivo',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_objetivo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Produto' =>
				array('className' => 'Produto',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_produto',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Requisito' =>
				array('className' => 'Requisito',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_requisito',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Responsabilidade' =>
				array('className' => 'Responsabilidade',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_responsabilidade',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Restricao' =>
				array('className' => 'Restricao',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_restricao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Servico' =>
				array('className' => 'Servico',
						'foreignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id, ds_servico',
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
			'Atividade' =>
				array('className' => 'Atividade',
						'joinTable' => 'atividades_estudosviabilidades_recursos',
						'foreignKey' => 'estudosviabilidade_id',
						'associationForeignKey' => 'atividade_id',
						'conditions' => '',
						'fields' => 'id, ds_atividade',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Contascusto' =>
				array('className' => 'Contascusto',
						'joinTable' => 'contascustos_estudosviabilidades',
						'foreignKey' => 'estudosviabilidade_id',
						'associationForeignKey' => 'contascusto_id',
						'conditions' => '',
						'fields' => 'id, vl_conta, ds_contacusto',
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
						'joinTable' => 'estudosviabilidades_usuarios',
						'foreignKey' => 'estudosviabilidade_id',
						'associationForeignKey' => 'usuario_id',
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
	 // salvar historico de todas movimentacoes workflow
   function salvaHistorico($sit, $id, $usuario){
      $data = date('d/m/y');
      $hora = date ('H:i:s');
      $user = $_SESSION['Usuario'];
      // 0 enviar contabilidade
      if ($sit == 0){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Estudo de Viabilidade enviado para Classificação Contábil efetuado pelo usuário $user em  $data as $hora')");
      }
      //1 classificar contabilmente
      else if ($sit == 1){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Estudo de Viabilidade Classificado Contabilmente efetuado pelo usuário $user em  $data as $hora')");
      }
      //2 enviar patrocinador
      else if ($sit == 2){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Estudo de Viabilidade enviado para Patrocinador efetuado pelo usuário $user em  $data as $hora')");
      }
      //3 aprovar estudo
      else if ($sit == 3){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Estudo de Viabilidade aprovado pelo usuário $user em  $data as $hora')");
      }
      //4 cancelar classificacao contabil do estudo
      else if ($sit == 4){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Cancelada a classificação contábil do Estudo de Viabilidade pelo usuário $user em  $data as $hora')");
      }
      //5 reprovar estudo
      else if ($sit == 5){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES
           ($id, $usuario, 'Estudo de Viabilidade Reprovado pelo usuário $user em  $data as $hora')");
      }
   }
   // pega no passo workflow a mensagem, a pessoa responsavel e coloca pra enviar mensagem
   function enviaMensagem($sit, $id, $usuario) {

      if($sit < 5) {
         // atualiza a data e hora de expiracao
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NOW() WHERE
         projeto_id = $id and nr_passo = $sit");
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE
         projeto_id = $id and nr_passo = $sit");
       }
      // atualiza a data de fechamento do passo anterior quando estiver no passo 2
      if (($sit > 1)&& ($sit < 5)){
         $this->execute("UPDATE passosworkflows SET dt_termino = NOW()
         WHERE projeto_id = $id and nr_passo = ($sit -1)");
      }
      //cancelada classificacao contabil do estudo
      else if ($sit == 5) {
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE
         projeto_id = $id and nr_passo = 1");
         $this->execute("UPDATE passosworkflows SET dt_termino = NULL, dt_ultima_expiracao = NULL
         WHERE projeto_id = $id and nr_passo = 1");
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NULL
         WHERE projeto_id = $id and nr_passo = 2");
      }
      else if ($sit == 6) {
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE
         projeto_id = $id and nr_passo = 2");
         $this->execute("UPDATE passosworkflows SET dt_termino = NULL, dt_ultima_expiracao = NOW()
         WHERE projeto_id = $id and nr_passo = 2");
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NULL
         WHERE projeto_id = $id and nr_passo = 3");
      }
      $user_responsavel = $workflow [0]['passosworkflows']['user_responsavel'];
      $mensagem_inicial = $workflow [0]['passosworkflows']['mensagem_inicial'];
      // 1 classificar contabilmente
      if ($sit == 1) {
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      else if ($sit == 2){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      else if ($sit == 3){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      else if ($sit == 4){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      else if ($sit == 5){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, 'Cancelada a classificação contábil do Estudo de Viabilidade', NOW(), '$user_responsavel' )");
      }
      else if ($sit == 6){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES
         ($id, 'Estudo de Viabilidade reprovado pelo Patrocinador favor verificar', NOW(), '$user_responsavel' )");
      }
   }
   
   function beforeSave(){
             if (!isset($this->data["Estudosviabilidade"]["id"])){
             $this->data["Estudosviabilidade"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Estudosviabilidade"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
