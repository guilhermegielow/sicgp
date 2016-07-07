<?php
class Passosworkflow extends AppModel {

	var $name = 'Passosworkflow';

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
    function enviaMensagemExpirada(){
       // le todos os projeto não encerrados
       $projetos = $this->query("SELECT id FROM projetos WHERE estado_id < 4");
       // le os projetos e os passos do workflow de tras pra frente ate achar um passo expirado

       for ($i = 0; $i < sizeof($projetos); $i++) {
           $x = 10;
           while($x > 0){
               $p = $projetos[$i]['projetos']['id'];
               $mensagens = $this->query("SELECT mensagem_expirada, user_responsavel, projeto_id, nr_passo FROM passosworkflows
               WHERE (projeto_id = $p and nr_passo = $x) and
               ((NOW() > (addtime(dt_ultima_expiracao,(concat( hr_expiracao, ':00:00' ) )))) and dt_termino is NULL and hr_expiracao > 0)");
                 if (sizeof($mensagens) == 1){
                    $ds_mensagem = $mensagens [0]['passosworkflows']['mensagem_expirada'];
                    $projeto_id = $mensagens [0]['passosworkflows']['projeto_id'];
                    $nm_envolvidos = $mensagens [0]['passosworkflows']['user_responsavel'];
                    $nr_passo = $mensagens [0]['passosworkflows']['nr_passo'];
                    // vai mandar mensagem
                    $this->execute("INSERT INTO mensagens (ds_mensagem, projeto_id, nm_envolvidos, dt_mensagem)
                    VALUES ("."'"."$ds_mensagem"."'".", $projeto_id, "."'"."$nm_envolvidos"."'".", NOW())");
                    // vai atualizar a data da ultima expiracao
                    $this->execute("UPDATE passosworkflows set dt_ultima_expiracao = NOW()
                     WHERE projeto_id = $projeto_id and nr_passo = $nr_passo");
                    $x = 0;
                   }
                 $x--;
          }
     }
}
}
?>
