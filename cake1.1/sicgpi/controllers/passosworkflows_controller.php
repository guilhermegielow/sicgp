<?php
class PassosworkflowsController extends AppController {

	var $name = 'Passosworkflows';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Passosworkflow->recursive = 0;
		$this->set('passosworkflows', $this->Passosworkflow->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Passosworkflow.');
			$this->redirect('/passosworkflows/index');
		}
		$this->set('passosworkflow', $this->Passosworkflow->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('projetos', $this->Passosworkflow->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Passosworkflow->save($this->data)) {
				$this->Session->setFlash('Passo do workflow inserido com sucesso.');
				$this->redirect('/passosworkflows/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Passosworkflow->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Passosworkflow');
				$this->redirect('/passosworkflows/index');
			}
			$this->data = $this->Passosworkflow->read(null, $id);
			$this->set('projetos', $this->Passosworkflow->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Passosworkflow->save($this->data)) {
				$this->Session->setFlash('Passo do workflow editado com sucesso.');
				$this->redirect('/passosworkflows/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Passosworkflow->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Passosworkflow');
			$this->redirect('/passosworkflows/index');
		}
		if($this->Passosworkflow->del($id)) {
			$this->Session->setFlash('Passo do workflow Excluído: id '.$id.'');
			$this->redirect('/passosworkflows/index');
		}
	}
	function verificaworkflow(){
      //chama a funcao para enviar mensagens dos passos que expiraram o tempo como parametro
      $this->Passosworkflow->enviaMensagemExpirada();
      $this->Session->setFlash('Mensagens Expiradas do workflow enviadas');
      $this->redirect('/passosworkflows/index');
    }

}
?>
