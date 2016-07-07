<?php
class AtividadesController extends AppController {

	var $name = 'Atividades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
    $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		$this->Atividade->recursive = 0;
		$this->set('atividades', $this->Atividade->findAll("Atividade.user_created = '$usuario'",'','Atividade.projeto_id desc'));
	}

	function view($id = null) {
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atividade.');
			$this->redirect('/atividades/index');
		}
		$this->set('atividade', $this->Atividade->read(null, $id));
	}

	function add() {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			$this->set('cronogramas', $this->Atividade->Cronograma->generateList("Cronograma.user_created = '$usuario'",'id desc'));
			$this->set('selectedCronogramas', null);
			$this->set('orcamentos', $this->Atividade->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
			$this->set('selectedOrcamentos', null);
			$this->set('projetos', $this->Atividade->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Atividade->save($this->data)) {
				$this->Session->setFlash('Atividade inserida com sucesso.');
				$this->redirect('/atividades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('cronogramas', $this->Atividade->Cronograma->generateList("Cronograma.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Cronograma']['Cronograma'])) { $this->data['Cronograma']['Cronograma'] = null; }
				$this->set('selectedCronogramas', $this->data['Cronograma']['Cronograma']);
				$this->set('orcamentos', $this->Atividade->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Orcamento']['Orcamento'])) { $this->data['Orcamento']['Orcamento'] = null; }
				$this->set('selectedOrcamentos', $this->data['Orcamento']['Orcamento']);
				$this->set('projetos', $this->Atividade->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
    $this->checkAcess();
    $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Atividade');
				$this->redirect('/atividades/index');
			}
			$this->data = $this->Atividade->read(null, $id);
			$this->set('cronogramas', $this->Atividade->Cronograma->generateList("Cronograma.user_created = '$usuario'",'id desc'));
			if(empty($this->data['Cronograma'])) { $this->data['Cronograma'] = null; }
			$this->set('selectedCronogramas', $this->_selectedArray($this->data['Cronograma']));
			$this->set('orcamentos', $this->Atividade->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
			if(empty($this->data['Orcamento'])) { $this->data['Orcamento'] = null; }
			$this->set('selectedOrcamentos', $this->_selectedArray($this->data['Orcamento']));
			$this->set('projetos', $this->Atividade->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Atividade->save($this->data)) {
				$this->Session->setFlash('Atividade editada com sucesso.');
				$this->redirect('/atividades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('cronogramas', $this->Atividade->Cronograma->generateList("Cronograma.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Cronograma']['Cronograma'])) { $this->data['Cronograma']['Cronograma'] = null; }
				$this->set('selectedCronogramas', $this->data['Cronograma']['Cronograma']);
				$this->set('orcamentos', $this->Atividade->Orcamento->generateList("Orcamento.user_created = '$usuario'",'id desc'));
				if(empty($this->data['Orcamento']['Orcamento'])) { $this->data['Orcamento']['Orcamento'] = null; }
				$this->set('selectedOrcamentos', $this->data['Orcamento']['Orcamento']);
				$this->set('projetos', $this->Atividade->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc', null, '{n}.Projeto.id', '{n}.Projeto.ds_titulo'));
			}
		}
	}
    function lista($id){
        $usuario = $_SESSION['Usuario'];
		$this->Atividade->recursive = 0;
		$this->set('atividades', $this->Atividade->findAll("Atividade.projeto_id = $id"));
    }
	function delete($id = null) {
	$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Atividade');
			$this->redirect('/atividades/index');
		}
		if($this->Atividade->del($id)) {
			$this->Session->setFlash('Atividade Excluída: id '.$id.'');
			$this->redirect('/atividades/index');
		}
	}

}
?>
