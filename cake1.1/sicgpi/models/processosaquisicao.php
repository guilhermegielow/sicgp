<?php
class Processosaquisicao extends AppModel {

	var $name = 'Processosaquisicao';
	var $validate = array(
		'planosaquisicao_id' => VALID_NOT_EMPTY,
		'fornecedor_id' => VALID_NOT_EMPTY,
		'ds_processo_aquisicao' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Planosaquisicao' =>
				array('className' => 'Planosaquisicao',
						'foreignKey' => 'planosaquisicao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Fornecedor' =>
				array('className' => 'Fornecedor',
						'foreignKey' => 'fornecedor_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
   // salvar historico de todas movimentacoes workflow
   function salvaHistorico($sit, $id, $usuario){
      $data = date('d/m/y');
      $hora = date ('H:i:s');
      // pega o id do usuario para colocar no historico
      $us = $this->query("SELECT id FROM usuarios WHERE ds_usuario = '$usuario'");
      $user = $us [0]['usuarios']['id'];
      // pega o id do projeto atraves do plano de aquisicao
      $p = $this->query("SELECT projeto_id FROM planosaquisicoes WHERE id = $id");
      $projeto_id = $p [0]['planosaquisicoes']['projeto_id'];
      // 0 enviar patrocinador
      if ($sit == 0){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($projeto_id, $user, 'Envio do Processo de Aquisição id = ".$id." para Patrocinador efetuado pelo usuário $usuario em  $data as $hora')");
      }
      //1 aprovar processo
      else if ($sit == 1){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($projeto_id, $user, 'Processo de Aquisição id = ".$id." aprovado efetuado pelo usuário $usuario em  $data as $hora')");
      }
           //1 aprovar processo
      else if ($sit == 2){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($projeto_id, $user, 'Processo de Aquisição id = ".$id." reprovado efetuado pelo usuário $usuario em  $data as $hora')");
      }
      
   }
   // pega no passo workflow a mensagem, a pessoa responsavel e coloca pra enviar mensagem
   function enviaMensagem($sit, $id, $usuario) {
      // pega o id do projeto atraves do plano de aquisicao
      $p = $this->query("SELECT projeto_id FROM planosaquisicoes WHERE id = $id");
      $projeto_id = $p [0]['planosaquisicoes']['projeto_id'];
      if ($sit < 7 ) {
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $projeto_id and nr_passo = $sit");
         // atualiza a data e hora de expiracao
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NOW() WHERE projeto_id = $projeto_id and nr_passo = $sit");
         // atualiza a data de fechamento do passo anterior quando estiver no passo 2
         if ($sit > 1){
            $this->execute("UPDATE passosworkflows SET dt_termino = NOW() WHERE projeto_id = $projeto_id and nr_passo = ($sit -1)");
            }
      }
      else if($sit == 7) {
           $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $projeto_id and nr_passo = 4");
           $this->execute("UPDATE passosworkflows SET dt_termino = NULL, dt_ultima_expiracao = NOW()  WHERE projeto_id = $projeto_id and nr_passo = 4");
           $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NULL
            WHERE projeto_id = $id and nr_passo = 5");
      }
      $user_responsavel = $workflow [0]['passosworkflows']['user_responsavel'];
      $mensagem_inicial = $workflow [0]['passosworkflows']['mensagem_inicial'];
      // 1 envia processo de aquisicao para patrocinador
      if ($sit == 5) {
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      // aprova processo de aquisicao
      else if ($sit == 6){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      // reprova processo de aquisicao
      else if ($sit == 7){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id, 'Processo de aquisição id = ".$id." reprovado pelo Patrocinador', NOW(), '$user_responsavel' )");
      }
      
   }
	function beforeSave(){
             if (!isset($this->data["Processosaquisicao"]["id"])){
             $this->data["Processosaquisicao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Processosaquisicao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
