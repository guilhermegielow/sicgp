<?php
class TermosaceitesprojetosController extends AppController {

	var $name = 'Termosaceitesprojetos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Termosaceitesprojeto->recursive = 0;
		$this->set('termosaceitesprojetos', $this->Termosaceitesprojeto->findAll("Termosaceitesprojeto.user_created = '$usuario'",'','Termosaceitesprojeto.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Termosaceitesprojeto.');
			$this->redirect('/termosaceitesprojetos/index');
		}
		$this->set('termosaceitesprojeto', $this->Termosaceitesprojeto->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('usuarios', $this->Termosaceitesprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('projetos', $this->Termosaceitesprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
            $this->data['Termosaceitesprojeto']['user_aprovacao'] = '';
			if($this->Termosaceitesprojeto->save($this->data)) {
				$this->Session->setFlash('Termo de aceite de projeto inserido com sucesso.');
				$this->redirect('/termosaceitesprojetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Termosaceitesprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Termosaceitesprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Termosaceitesprojeto');
				$this->redirect('/termosaceitesprojetos/index');
			}
			$this->data = $this->Termosaceitesprojeto->read(null, $id);
			$this->set('usuarios', $this->Termosaceitesprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('projetos', $this->Termosaceitesprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Termosaceitesprojeto->save($this->data)) {
				$this->Session->setFlash('Termo de aceite de projeto editado com sucesso.');
				$this->redirect('/termosaceitesprojetos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Termosaceitesprojeto->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Termosaceitesprojeto->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Termosaceitesprojeto');
			$this->redirect('/termosaceitesprojetos/index');
		}
		if($this->Termosaceitesprojeto->del($id)) {
			$this->Session->setFlash('Termo de aceite de projeto Excluído: id '.$id.'');
			$this->redirect('/termosaceitesprojetos/index');
		}
	}
    function enviarpatrocinador($id) {
             $this->checkAcess();
             $someone = $this->Termosaceitesprojeto->Usuario->findByDs_usuario($_SESSION['Usuario']);
             $this->data = $this->Termosaceitesprojeto->read(null, $id);
             //grava como enviado para patrocinador
             $dados = array("Termosaceitesprojeto"=>
             array(
              "id"=>$id,
              "log_envio_patrocinador"=>1
              )
              );
              $this->Termosaceitesprojeto->set($dados);
              $this->Termosaceitesprojeto->save();
             //gravar historico do envio do termo de aceite de projeto para o patrocinador
             $this->Termosaceitesprojeto->salvaHistorico(0,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
             //gerar mensagem para patrocinador
             $this->Termosaceitesprojeto->enviaMensagem(9,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
             $this->Session->setFlash('Termo de aceite de projeto Enviado para Patrocinador com sucesso');
             $this->redirect('/termosaceitesprojetos/index');
    }
   	function aprovacao($id = null) {
        if(!$id) {
			$this->Session->setFlash('ID inválido para Termosaceitesprojeto.');
			$this->redirect('/termosaceitesprojetos/index');
		}
		$this->set('termosaceitesprojeto', $this->Termosaceitesprojeto->read(null, $id));
	}
   	function aprovarprojeto($id) {
        $data = date('y-m-d');
        $this->data = $this->Termosaceitesprojeto->read(null, $id);
        $someone = $this->Termosaceitesprojeto->Usuario->findByDs_usuario($_SESSION['Usuario']);
        //grava como aprovado o projeto
        $dados = array("Termosaceitesprojeto"=>
           array(
              "id"=>$id,
              "dt_aceite"=>$data,
              "user_aceite"=>$_SESSION['Usuario']
              )
              );
              $this->Termosaceitesprojeto->set($dados);
              $this->Termosaceitesprojeto->save();
        //grava historico de aprovacao dprojeto
      	$this->Termosaceitesprojeto->salvaHistorico(1,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
      	//gerar mensagem para gerente de projetos
      	$this->Termosaceitesprojeto->enviaMensagem(10,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
      	$this->Session->setFlash('Termo de Aceite Aprovado com sucesso');
        $this->redirect($_SESSION["Mapa"]);
        }
   	function reprovarprojeto($id) {
        $data = date('y-m-d');
        $this->data = $this->Termosaceitesprojeto->read(null, $id);
        $someone = $this->Termosaceitesprojeto->Usuario->findByDs_usuario($_SESSION['Usuario']);
        //grava como reprovado o projeto
        $dados = array("Termosaceitesprojeto"=>
           array(
              "id"=>$id,
              "log_envio_patrocinador"=>0
              )
              );
              $this->Termosaceitesprojeto->set($dados);
              $this->Termosaceitesprojeto->save();
        //grava historico de reprovacao projeto
      	$this->Termosaceitesprojeto->salvaHistorico(2,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
      	//gerar mensagem para gerente de projetos
      	$this->Termosaceitesprojeto->enviaMensagem(11,$this->data['Termosaceitesprojeto']['projeto_id'],$someone['Usuario']['id']);
      	$this->Session->setFlash('Termo de Aceite Reprovado com sucesso');
        $this->redirect($_SESSION["Mapa"]);
        }
}
?>
