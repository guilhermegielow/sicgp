<?php
class Controlesmudanca extends AppModel {

	var $name = 'Controlesmudanca';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'tiposmudanca_id' => VALID_NOT_EMPTY,
		'prioridade_id' => VALID_NOT_EMPTY,
		'ds_controle_mudanca' => VALID_NOT_EMPTY,
		'ds_justificativa' => VALID_NOT_EMPTY,
		'ds_impacto' => VALID_NOT_EMPTY,
		'dt_comunicacao' => VALID_NOT_EMPTY,
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

			'Tiposmudanca' =>
				array('className' => 'Tiposmudanca',
						'foreignKey' => 'tiposmudanca_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Prioridade' =>
				array('className' => 'Prioridade',
						'foreignKey' => 'prioridade_id',
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
      $us = $this->query("SELECT id FROM usuarios WHERE ds_usuario = '$usuario'");
      $user = $us [0]['usuarios']['id'];
      //0 enviar patrocinador
      if ($sit == 0){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $user, 'Controle de Mudança id = ".$id." enviado para Patrocinador efetuado pelo usuário $usuario em  $data as $hora')");
      }
      //1 aprovar controle de mudanca
      else if ($sit == 1){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $user, 'Aprovado Controle de Mudança id = ".$id." pelo usuário $usuario em  $data as $hora')");
      }
      //2 reprovar controle de mudanca
      else if ($sit == 2){
           $this->execute("INSERT INTO historicos (projeto_id, usuario_id, ds_historico) VALUES ($id, $user, 'Reprovado Controle de Mudança id = ".$id." pelo usuário $usuario em  $data as $hora')");
      }
   }
   // pega no passo workflow a mensagem, a pessoa responsavel e coloca pra enviar mensagem
   function enviaMensagem($sit, $id, $usuario) {
      // atualiza a data de fechamento do passo anterior quando estiver no passo 2
      if ($sit < 9){
         $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $id and nr_passo = $sit");
         // atualiza a data e hora de expiracao
         $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NOW() WHERE projeto_id = $id and nr_passo = $sit");
         if ($sit > 1){
            $this->execute("UPDATE passosworkflows SET dt_termino = NOW() WHERE projeto_id = $id and nr_passo = ($sit -1)");
            }
      }
      else if ($sit == 9) {
           $workflow = $this->query("SELECT user_responsavel, mensagem_inicial FROM passosworkflows WHERE projeto_id = $id and nr_passo = 6");
           $this->execute("UPDATE passosworkflows SET dt_termino = NULL, dt_ultima_expiracao = NOW() WHERE projeto_id = $id and nr_passo = 6");
           $this->execute("UPDATE passosworkflows SET dt_ultima_expiracao = NULL
           WHERE projeto_id = $id and nr_passo = 7");
      }
      $user_responsavel = $workflow [0]['passosworkflows']['user_responsavel'];
      $mensagem_inicial = $workflow [0]['passosworkflows']['mensagem_inicial'];
      // 7 enviar patrocinador
      if ($sit == 7) {
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      //8 aprovar controle de mudanca
      else if ($sit == 8){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
      //9 reprovar controle de mudanca
      else if ($sit == 9){
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($id, '$mensagem_inicial', NOW(), '$user_responsavel' )");
      }
   }
	function beforeSave(){
             if (!isset($this->data["Controlesmudanca"]["id"])){
             $this->data["Controlesmudanca"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Controlesmudanca"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
