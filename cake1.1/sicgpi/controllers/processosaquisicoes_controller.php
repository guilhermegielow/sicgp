<?php
class ProcessosaquisicoesController extends AppController {

	var $name = 'Processosaquisicoes';
	var $helpers = array('Html', 'Form' );

	function index() {
	    $this->pageTitle = 'Processo de aquisição';
        $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		$this->Processosaquisicao->recursive = 0;
		$this->set('processosaquisicoes', $this->Processosaquisicao->findAll("Processosaquisicao.user_created = '$usuario'",'','Processosaquisicao.planosaquisicao_id desc'));
	}

	function view($id = null) {
	    $this->pageTitle = 'Processo de aquisição';
		$this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Processosaquisicao.');
			$this->redirect('/processosaquisicoes/index');
		}
		$this->set('processosaquisicao', $this->Processosaquisicao->read(null, $id));
	}

	function add() {
	    $this->pageTitle = 'Processo de aquisição';
		$this->checkAcess();
        if(empty($this->data)) {
			$this->set('planosaquisicoes', $this->Processosaquisicao->Planosaquisicao->generateList(null,'id desc', null, '{n}.Planosaquisicao.id', '{n}.Planosaquisicao.ds_plano_aquisicao'));
			$this->set('fornecedores', $this->Processosaquisicao->Fornecedor->generateList(null,'nm_fornecedor', null, '{n}.Fornecedor.id', '{n}.Fornecedor.nm_fornecedor'));
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['Processosaquisicao']['user_aprovacao'] = '';
			if($this->Processosaquisicao->save($this->data)) {
				$this->Session->setFlash('Processo de aquisição inserido com sucesso.');
				$this->redirect('/processosaquisicoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('planosaquisicoes', $this->Processosaquisicao->Planosaquisicao->generateList(null,'ds_plano_aquisicao', null, '{n}.Planosaquisicao.id', '{n}.Planosaquisicao.ds_plano_aquisicao'));
				$this->set('fornecedores', $this->Processosaquisicao->Fornecedor->generateList(null,'nm_fornecedor', null, '{n}.Fornecedor.id', '{n}.Fornecedor.nm_fornecedor'));
			}
		}
	}

	function edit($id = null) {
	    $this->pageTitle = 'Processo de aquisição';
		$this->checkAcess();
        if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Processosaquisicao');
				$this->redirect('/processosaquisicoes/index');
			}
			$this->data = $this->Processosaquisicao->read(null, $id);
			$this->set('planosaquisicoes', $this->Processosaquisicao->Planosaquisicao->generateList(null,'ds_plano_aquisicao', null, '{n}.Planosaquisicao.id', '{n}.Planosaquisicao.ds_plano_aquisicao'));
			$this->set('fornecedores', $this->Processosaquisicao->Fornecedor->generateList(null,'nm_fornecedor', null, '{n}.Fornecedor.id', '{n}.Fornecedor.nm_fornecedor'));
		} else {
			$this->cleanUpFields();
			if($this->Processosaquisicao->save($this->data)) {
				$this->Session->setFlash('Processo de aquisição editado com sucesso.');
				$this->redirect('/processosaquisicoes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('planosaquisicoes', $this->Processosaquisicao->Planosaquisicao->generateList(null,'ds_plano_aquisicao', null, '{n}.Planosaquisicao.id', '{n}.Planosaquisicao.ds_plano_aquisicao'));
				$this->set('fornecedores', $this->Processosaquisicao->Fornecedor->generateList(null,'nm_fornecedor', null, '{n}.Fornecedor.id', '{n}.Fornecedor.nm_fornecedor'));
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
        if(!$id) {
			$this->Session->setFlash('ID inválido para Processosaquisicao');
			$this->redirect('/processosaquisicoes/index');
		}
		if($this->Processosaquisicao->del($id)) {
			$this->Session->setFlash('Processo de aquisição Excluído: id '.$id.'');
			$this->redirect('/processosaquisicoes/index');
		}
	}
  function enviarpatrocinador($id) {
        $this->checkAcess();
        $this->Processosaquisicao->read(null, $id);
        $plano = $this->Processosaquisicao->findById($id);
        $usuario = $_SESSION['Usuario'];
        //grava como enviado para patrocinador
        $dados = array("Processosaquisicao"=>
              array(
              "id"=>$id,
              "log_envio_patrocinador"=>1
              )
              );
        $this->Processosaquisicao->set($dados);
        $this->Processosaquisicao->save();
        //gravar historico do envio para patrocinador
        $this->Processosaquisicao->salvaHistorico(0,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        //gerar mensagem para patrocinador
        $this->Processosaquisicao->enviaMensagem(5,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        $this->Session->setFlash('Estudo de Viabilidade Enviado para Patrocinador com sucesso');
        $this->redirect('/processosaquisicoes/index');
    }
	function aprovacao($id = null) {
	    $this->pageTitle = 'Aprovar Processo de aquisição';
        if(!$id) {
			$this->Session->setFlash('ID inválido para Processosaquisicao.');
			$this->redirect('/processosaquisicoes/index');
		}
		$this->set('processosaquisicao', $this->Processosaquisicao->read(null, $id));
	}
	function aprovarprocesso($id) {
        $usuario = $_SESSION['Usuario'];
        $data = date('y-m-d');
        $plano = $this->Processosaquisicao->findById($id);
        $this->set('processosaquisicao', $this->Processosaquisicao->read(null, $id));
        //grava como aprovado o processo de aquisicao
        $dados = array("Processosaquisicao"=>
           array(
              "id"=>$id,
              "dt_aprovacao"=>$data,
              "user_aprovacao"=>$_SESSION['Usuario']
              )
              );
              $this->Processosaquisicao->set($dados);
              $this->Processosaquisicao->save();
        //gravar no historico
        $this->Processosaquisicao->salvaHistorico(1,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        //gerar mensagem para gerente de projetos
        $this->Processosaquisicao->enviaMensagem(6,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        $this->redirect($_SESSION['Mapa']);
	}
	function reprovarprocesso($id) {
        $usuario = $_SESSION['Usuario'];
        $data = date('y-m-d');
        $plano = $this->Processosaquisicao->findById($id);
        $this->set('processosaquisicao', $this->Processosaquisicao->read(null, $id));
        //grava como reprovado o processo de aquisicao
        $dados = array("Processosaquisicao"=>
           array(
              "id"=>$id,
              "log_envio_patrocinador"=>0
              )
              );
              $this->Processosaquisicao->set($dados);
              $this->Processosaquisicao->save();
        //gravar no historico
        $this->Processosaquisicao->salvaHistorico(2,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        //gerar mensagem para gerente de projetos
        $this->Processosaquisicao->enviaMensagem(7,$plano['Processosaquisicao']['planosaquisicao_id'],$usuario);
        $this->redirect($_SESSION['Mapa']);
	}
}
?>
