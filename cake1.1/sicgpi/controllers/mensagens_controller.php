<?php
class MensagensController extends AppController {

	var $name = 'Mensagens';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');
    var $uses = array('Mensagem', 'Usuario');
    var $components = array('Email');
    function index() {
        $this->Mensagem->recursive = 0;
		$this->set('mensagens', $this->Mensagem->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Mensagem.');
			$this->redirect('/mensagens/index');
		}
		$this->set('mensagem', $this->Mensagem->read(null, $id));
	}

	function add() {
		$this->checkAcess();
        if(empty($this->data)) {
			$this->set('projetos', $this->Mensagem->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Mensagem->save($this->data)) {
                $this->Session->setFlash('Mensagem inserida com sucesso.');
				$this->redirect('/mensagens/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Mensagem->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Mensagem');
				$this->redirect('/mensagens/index');
			}
			$this->data = $this->Mensagem->read(null, $id);
			$this->set('projetos', $this->Mensagem->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Mensagem->save($this->data)) {
				$this->Session->setFlash('Mensagem editada com sucesso.');
				$this->redirect('/mensagens/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Mensagem->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}
	function enviaemail(){
                //le mensagens pendentes para enviar
                $email = $this->Mensagem->lePendentes();
                for ($i = 0; $i < sizeof($email); $i++) {
                    $destino = $this->Usuario->findByDs_usuario($email[$i]['mensagens']['nm_envolvidos']);
                    $id = $email[$i]['mensagens']['id'];
                    $this->Email->template = 'email/default'; // Template a ser usado no envio
                    $data = $email[$i]['mensagens']['ds_mensagem'];
                    $this->set('data',$data); // Conteúdo dinamico a ser passado para o template (opcional)
                    $this->Email->to = $destino['Usuario']['ds_email']; // Destinatário
                    // traz o nome do projeto para o titulo do e-mail
                    $nomeProjeto = $this->Mensagem->Projeto->findById($email[$i]['mensagens']['projeto_id']);

                    $this->Email->subject = 'Mensagem do SICGPI do projeto '.$nomeProjeto['Projeto']['ds_titulo']; // Assunto do email
                    $result = $this->Email->send(); // necessário para enviar os emails
                    if ($result == 1) {
                       //grava como mensagem enviada
                       $dados = array("Mensagem"=>
                       array(
                       "id"=>$email[$i]['mensagens']['id'],
                       "enviado"=>1
                       )
                       );
                       $this->Mensagem->set($dados);
                       $this->Mensagem->save();
                    }
                }
                if ($result == 1){
                   $this->Session->setFlash(sizeof($email).' Mensagens enviadas com sucesso.');
                 }
                else {
                   $this->Session->setFlash('Não existem mensagens para enviar.');
                }
                $this->redirect('/mensagens/index');
                }
	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Mensagem');
			$this->redirect('/mensagens/index');
		}
		if($this->Mensagem->del($id)) {
			$this->Session->setFlash('Mensagem Excluído: id '.$id.'');
			$this->redirect('/mensagens/index');
		}
	}

}
?>
