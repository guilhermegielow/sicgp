<?php
class Elementoseap extends AppModel {

	var $name = 'Elementoseap';
	var $validate = array(
		'atividade_id' => VALID_NOT_EMPTY,
		'vl_planejado' => VALID_NOT_EMPTY,
		'vl_perc_concluido' => VALID_NOT_EMPTY,
		'dt_planejada' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Atividade' =>
				array('className' => 'Atividade',
						'foreignKey' => 'atividade_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
   // pega o numero da atividade, a pessoa responsavel, usuario solicitante e coloca pra enviar mensagem
   function enviaMensagem($id, $usuario_s, $usuario_r) {
         $atividade = $this->query("SELECT projeto_id, ds_atividade FROM atividades where id = $id");
         $ds_atividade = $atividade [0] ['atividades']['ds_atividade'];
         $projeto_id = $atividade[0]['atividades']['projeto_id'];
         // mensagem para o responsavel
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id,
         'A atividade $ds_atividade foi solicitada para você pelo usuário $usuario_s', NOW(), '$usuario_r')");
         // mensagem para o solicitante
         $this->execute("INSERT INTO mensagens (projeto_id, ds_mensagem, dt_mensagem, nm_envolvidos) VALUES ($projeto_id,
         'A atividade $ds_atividade foi solicitada por você para o usuário $usuario_r', NOW(), '$usuario_s' )");
   }
	function beforeSave(){
             if (!isset($this->data["Elementoseap"]["id"])){
             $this->data["Elementoseap"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Elementoseap"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
