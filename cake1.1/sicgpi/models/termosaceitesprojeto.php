<?php
class Termosaceitesprojeto extends AppModel {

	var $name = 'Termosaceitesprojeto';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_local' => VALID_NOT_EMPTY,
		'ds_resumo_projeto' => VALID_NOT_EMPTY,
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
			'ProdutosServicosTermosaceitesprojeto' =>
				array('className' => 'ProdutosServicosTermosaceitesprojeto',
						'foreignKey' => 'termosaceitesprojeto_id',
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
			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'termosaceitesprojetos_usuarios',
						'foreignKey' => 'termosaceitesprojeto_id',
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
   // salvar historico de todas movimentacoes workflow
   function salvaHistorico($sit, $id, $usuario){
      $data = date('d/m/y');
      $hora = date ('H:i:s');
      $user = $_SESSION['Usuario'];
      //0 enviar patrocinador
      if ($sit == 0){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $usuario, 'Projeto enviado para o Patrocinador efetuado pelo usuário $user em  $data as $hora')");
      }
      //1 aprovar projeto
      else if ($sit == 1){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $usuario, 'Projeto Aprovado pelo usuário $user em  $data as $hora')");
      }
      //2 reprovar projeto
      else if ($sit == 2){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $usuario, 'Projeto Reprovado pelo usuário $user em  $data as $hora')");
      }
   }
   // pega no passo workflow a mensagem, a pessoa responsavel e coloca pra enviar mensagem
   function enviaMensagem($sit, $id, $usuario) {
      // atualiza a data de fechamento do passo anterior quando estiver no passo 2
      if ($sit < 11) {
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $id and nr_passo = $sit");
         // atualiza a data e hora de expiracao
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NOW() WHERE projeto_id = $id and nr_passo = $sit");
         if (($sit > 1)&&($sit < 10)){
            $this->execute("UPDATE passosworkflows SET dt_termino = NOW() WHERE projeto_id = $id and nr_passo = ($sit -1)");
            }
         // passo final do projeto
         else if ($sit == 10){
            $this->execute("UPDATE passosworkflows SET dt_termino = NOW() WHERE projeto_id = $id and nr_passo = $sit");
         }
      }
      else if($sit == 11){
           $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $id and nr_passo = 8");
           $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NOW(), dt_termino = NULL WHERE projeto_id = $id and nr_passo = 8");
           $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NULL
           WHERE projeto_id = $id and nr_passo = 9");
      }
      $user_responsavel = $workflow [0]['passosworkflows']['user_responsavel'];
      $mensagem_inicial = $workflow [0]['passosworkflows']['mensagem_inicial'];
      // 9 enviar patrocinador
      if ($sit == 9) {
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      //10 aprovar projeto
      else if ($sit == 10){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      //11 reprovar projeto
      else if ($sit == 11){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, 'Projeto reprovado pelo Patrocinador', NOW(), '$user_responsavel' )");
      }

   }
	function beforeSave(){
             if (!isset($this->data["Termosaceitesprojeto"]["id"])){
             $this->data["Termosaceitesprojeto"]["user_created"] = $_SESSION['Usuario'];
             $this->data["Termosaceitesprojeto"]["user_aceite"] = '';
             }
             $this->data["Termosaceitesprojeto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
