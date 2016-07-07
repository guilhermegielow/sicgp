a<?php
class DicionarioseapsController extends AppController {

	var $name = 'Dicionarioseaps';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    $this->Dicionarioseap->recursive = 0;
		$this->set('dicionarioseaps', $this->Dicionarioseap->findAll("Dicionarioseap.user_created = '$usuario'", '','Dicionarioseap.projeto_id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Dicionarioseap.');
			$this->redirect('/dicionarioseaps/index');
		}
		$this->set('dicionarioseap', $this->Dicionarioseap->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('usuarios', $this->Dicionarioseap->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('atividades', $this->Dicionarioseap->Atividade->generateList("Atividade.user_created = '$usuario'",'id desc', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('projetos', $this->Dicionarioseap->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('tiposespecificacoes', $this->Dicionarioseap->Tiposespecificacao->generateList(null,'ds_tipo_especificacao', null, '{n}.Tiposespecificacao.id', '{n}.Tiposespecificacao.ds_tipo_especificacao'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Dicionarioseap->save($this->data)) {
				$this->Session->setFlash('Dicionário da eap inserido com sucesso.');
				$this->redirect('/dicionarioseaps/index');
			} else {
                // coloca o cabecalho da mensagem
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				// le os dados novamente para corrigir os erros
				$this->set('usuarios', $this->Dicionarioseap->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('atividades', $this->Dicionarioseap->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				$this->set('projetos', $this->Dicionarioseap->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('tiposespecificacoes', $this->Dicionarioseap->Tiposespecificacao->generateList(null,'ds_tipo_especificacao', null, '{n}.Tiposespecificacao.id', '{n}.Tiposespecificacao.ds_tipo_especificacao'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Dicionarioseap');
				$this->redirect('/dicionarioseaps/index');
			}
			$this->data = $this->Dicionarioseap->read(null, $id);
			$this->set('usuarios', $this->Dicionarioseap->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('atividades', $this->Dicionarioseap->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
			$this->set('projetos', $this->Dicionarioseap->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->set('tiposespecificacoes', $this->Dicionarioseap->Tiposespecificacao->generateList(null,'ds_tipo_especificacao', null, '{n}.Tiposespecificacao.id', '{n}.Tiposespecificacao.ds_tipo_especificacao'));
		} else {
			$this->cleanUpFields();
			if($this->Dicionarioseap->save($this->data)) {
				$this->Session->setFlash('Dicionário da eap editado com sucesso.');
				$this->redirect('/dicionarioseaps/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Dicionarioseap->Usuario->generateList(null,'ds_usuario', null, '{n}.Usuario.id', '{n}.Usuario.ds_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('atividades', $this->Dicionarioseap->Atividade->generateList("Atividade.user_created = '$usuario'",'ds_atividade', null, '{n}.Atividade.id', '{n}.Atividade.ds_atividade'));
				$this->set('projetos', $this->Dicionarioseap->Projeto->generateList("Projeto.user_created = '$usuario'",'ds_titulo', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
				$this->set('tiposespecificacoes', $this->Dicionarioseap->Tiposespecificacao->generateList(null,'ds_tipo_especificacao', null, '{n}.Tiposespecificacao.id', '{n}.Tiposespecificacao.ds_tipo_especificacao'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Dicionarioseap');
			$this->redirect('/dicionarioseaps/index');
		}
		if($this->Dicionarioseap->del($id)) {
			$this->Session->setFlash('Dicionário da eap Excluído: id '.$id.'');
			$this->redirect('/dicionarioseaps/index');
		}
	}

}
?>
