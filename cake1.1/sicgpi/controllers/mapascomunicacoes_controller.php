<?php
class MapascomunicacoesController extends AppController {

	var $name = 'Mapascomunicacoes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		$this->Mapascomunicacao->recursive = 0;
		$this->set('mapascomunicacoes', $this->Mapascomunicacao->findAll("Mapascomunicacao.user_created = '$usuario'", '','Mapascomunicacao.id desc'));
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Mapascomunicacao.');
			$this->redirect('/mapascomunicacoes/index');
		}
		$this->set('mapascomunicacao', $this->Mapascomunicacao->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			$this->set('usuarios', $this->Mapascomunicacao->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			$this->set('selectedUsuarios', null);
			$this->set('projetos', $this->Mapascomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Mapascomunicacao->save($this->data)) {
				$this->Session->setFlash('Mapa de comunicação inserido com sucesso.');
				$this->redirect('/mapascomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Mapascomunicacao->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Mapascomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Mapascomunicacao');
				$this->redirect('/mapascomunicacoes/index');
			}
			$this->data = $this->Mapascomunicacao->read(null, $id);
			$this->set('usuarios', $this->Mapascomunicacao->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
			if(empty($this->data['Usuario'])) { $this->data['Usuario'] = null; }
			$this->set('selectedUsuarios', $this->_selectedArray($this->data['Usuario']));
			$this->set('projetos', $this->Mapascomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Mapascomunicacao->save($this->data)) {
				$this->Session->setFlash('Mapa de comunicação editado com sucesso.');
				$this->redirect('/mapascomunicacoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('usuarios', $this->Mapascomunicacao->Usuario->generateList(null,'nm_usuario', null, '{n}.Usuario.id', '{n}.Usuario.nm_usuario'));
				if(empty($this->data['Usuario']['Usuario'])) { $this->data['Usuario']['Usuario'] = null; }
				$this->set('selectedUsuarios', $this->data['Usuario']['Usuario']);
				$this->set('projetos', $this->Mapascomunicacao->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Mapascomunicacao');
			$this->redirect('/mapascomunicacoes/index');
		}
		if($this->Mapascomunicacao->del($id)) {
			$this->Session->setFlash('Mapa de comunicação Excluído: id '.$id.'');
			$this->redirect('/mapascomunicacoes/index');
		}
	}

}
?>
