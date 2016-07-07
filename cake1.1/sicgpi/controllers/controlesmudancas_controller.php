<?php
class ControlesmudancasController extends AppController {

	var $name = 'Controlesmudancas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Controlesmudanca->recursive = 0;
		$this->set('controlesmudancas', $this->Controlesmudanca->findAll("Controlesmudanca.user_created = '$usuario'", '','Controlesmudanca.projeto_id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Controlesmudanca.');
			$this->redirect('/controlesmudancas/index');
		}
		$this->set('controlesmudanca', $this->Controlesmudanca->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Controlesmudanca->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('tiposmudancas', $this->Controlesmudanca->Tiposmudanca->generateList(null,'ds_tipo_mudanca', null, '{n}.Tiposmudanca.id', '{n}.Tiposmudanca.ds_tipo_mudanca'));
			$this->set('prioridades', $this->Controlesmudanca->Prioridade->generateList(null,'ds_prioridade', null, '{n}.Prioridade.id', '{n}.Prioridade.ds_prioridade'));
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['Controlesmudanca']['user_aprovacao'] = '';
			if($this->Controlesmudanca->save($this->data)) {
				$this->Session->setFlash('Controle de mudança inserido com sucesso.');
				$this->redirect('/controlesmudancas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Controlesmudanca->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('tiposmudancas', $this->Controlesmudanca->Tiposmudanca->generateList(null,'ds_tipo_mudanca', null, '{n}.Tiposmudanca.id', '{n}.Tiposmudanca.ds_tipo_mudanca'));
				$this->set('prioridades', $this->Controlesmudanca->Prioridade->generateList(null,'ds_prioridade', null, '{n}.Prioridade.id', '{n}.Prioridade.ds_prioridade'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Controlesmudanca');
				$this->redirect('/controlesmudancas/index');
			}
			$this->data = $this->Controlesmudanca->read(null, $id);
			$this->set('projetos', $this->Controlesmudanca->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('tiposmudancas', $this->Controlesmudanca->Tiposmudanca->generateList(null,'ds_tipo_mudanca', null, '{n}.Tiposmudanca.id', '{n}.Tiposmudanca.ds_tipo_mudanca'));
			$this->set('prioridades', $this->Controlesmudanca->Prioridade->generateList(null,'ds_prioridade', null, '{n}.Prioridade.id', '{n}.Prioridade.ds_prioridade'));
		} else {
			$this->cleanUpFields();
			if($this->Controlesmudanca->save($this->data)) {
				$this->Session->setFlash('Controle de mudança editado com sucesso.');
				$this->redirect('/controlesmudancas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Controlesmudanca->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('tiposmudancas', $this->Controlesmudanca->Tiposmudanca->generateList(null,'ds_tipo_mudanca', null, '{n}.Tiposmudanca.id', '{n}.Tiposmudanca.ds_tipo_mudanca'));
				$this->set('prioridades', $this->Controlesmudanca->Prioridade->generateList(null,'ds_prioridade', null, '{n}.Prioridade.id', '{n}.Prioridade.ds_prioridade'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Controlesmudanca');
			$this->redirect('/controlesmudancas/index');
		}
		if($this->Controlesmudanca->del($id)) {
			$this->Session->setFlash('Controle de mudança Excluído: id '.$id.'');
			$this->redirect('/controlesmudancas/index');
		}
	}
    function enviarpatrocinador($id) {
             $usuario = $_SESSION['Usuario'];
             $this->checkAcess();
             $this->data = $this->Controlesmudanca->read(null, $id);
             //grava como enviado para patrocinador
             $dados = array("Controlesmudanca"=>
             array(
              "id"=>$id,
              "log_envio_patrocinador"=>1
              )
              );
              $this->Controlesmudanca->set($dados);
              $this->Controlesmudanca->save();
             //gravar historico do envio do controle de mudanca para o patrocinador
             $this->Controlesmudanca->salvaHistorico(0,$this->data['Controlesmudanca']['projeto_id'],$usuario);
             //gerar mensagem para patrocinador
             $this->Controlesmudanca->enviaMensagem(7,$this->data['Controlesmudanca']['projeto_id'],$usuario);
             $this->Session->setFlash('Controle de Mudança Enviado para Patrocinador com sucesso');
             $this->redirect('/controlesmudancas/index');
    }
   	function aprovacao($id = null) {
   	    $usuario = $_SESSION['Usuario'];
        if(!$id) {
			$this->Session->setFlash('ID inválido para Controlesmudanca.');
			$this->redirect('/controlesmudancas/index');
		}
		$this->set('controlesmudanca', $this->Controlesmudanca->read(null, $id));
	}
	function aprovarmudanca($id){
        $usuario = $_SESSION['Usuario'];
        $data = date('y-m-d');
        $this->data = $this->Controlesmudanca->read(null, $id);
        //grava como aprovado o controle de mudanca
        $dados = array("Controlesmudanca"=>
           array(
              "id"=>$id,
              "dt_aprovacao"=>$data,
              "user_aprovacao"=>$_SESSION['Usuario']
              )
              );
              $this->Controlesmudanca->set($dados);
              $this->Controlesmudanca->save();
        //grava historico de aprovacao de controle de mudanca
      	$this->Controlesmudanca->salvaHistorico(1,$this->data['Controlesmudanca']['projeto_id'],$usuario);
      	//gerar mensagem para gerente de projetos
      	$this->Controlesmudanca->enviaMensagem(8,$this->data['Controlesmudanca']['projeto_id'],$usuario);
      	$this->Session->setFlash('Controle de Mudança Aprovado com sucesso');
        $this->redirect($_SESSION['Mapa']);
        }
	function reprovarmudanca($id){
        $usuario = $_SESSION['Usuario'];
        $this->checkAcess();
        $data = date('y-m-d');
        $this->data = $this->Controlesmudanca->read(null, $id);
        //grava como aprovado o controle de mudanca
        $dados = array("Controlesmudanca"=>
           array(
              "id"=>$id,
              "log_envio_patrocinador"=>0
              )
              );
              $this->Controlesmudanca->set($dados);
              $this->Controlesmudanca->save();
        //grava historico de reprovacao de controle de mudanca
      	$this->Controlesmudanca->salvaHistorico(2,$this->data['Controlesmudanca']['projeto_id'],$usuario);
      	//gerar mensagem para gerente de projetos
      	$this->Controlesmudanca->enviaMensagem(9,$this->data['Controlesmudanca']['projeto_id'],$usuario);
      	$this->Session->setFlash('Controle de Mudança Reprovado com sucesso');
        $this->redirect($_SESSION['Mapa']);
        }

}
?>
