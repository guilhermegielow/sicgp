<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');
    var $components = array('Acl');

	function index() {
        $this->checkAcess();
        $this->pageTitle = 'Usuário';
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->Usuario->findAll());
	}

	function view($id = null) {
        $this->pageTitle = 'Usuário';
		if(!$id) {
			$this->Session->setFlash('ID inválido para Usuario.');
			$this->redirect('/usuarios/index');
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}

	function add() {
      $this->pageTitle = 'Usuário';
	  $this->checkAcess();
		if(empty($this->data)) {
			$this->set('acoes', $this->Usuario->Acao->generateList(null,'ds_acao', null, '{n}.Acao.id', '{n}.Acao.ds_acao'));
			$this->set('selectedAcoes', null);
			$this->set('acoesrelatorios', $this->Usuario->Acoesrelatorio->generateList(null,'ds_acao_relatorio', null, '{n}.AcoesRelatorio.id', '{n}.AcoesRelatorio.ds_acao_relatorio'));
			$this->set('selectedAcoesrelatorios', null);
			$this->set('declaracoesescopos', $this->Usuario->Declaracoesescopo->generateList());
			$this->set('selectedDeclaracoesescopos', null);
			$this->set('dicionarioseaps', $this->Usuario->Dicionarioseap->generateList());
			$this->set('selectedDicionarioseaps', null);
			$this->set('estudosviabilidades', $this->Usuario->Estudosviabilidade->generateList());
			$this->set('selectedEstudosviabilidades', null);
			$this->set('mapascomunicacoes', $this->Usuario->Mapascomunicacao->generateList());
			$this->set('selectedMapascomunicacoes', null);
			$this->set('planosprojetos', $this->Usuario->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
			$this->set('selectedPlanosprojetos', null);
			$this->set('termosaceitesprojetos', $this->Usuario->Termosaceitesprojeto->generateList());
			$this->set('selectedTermosaceitesprojetos', null);
			$this->set('departamentos', $this->Usuario->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Usuario->save($this->data)) {
				$this->Session->setFlash('Usuário inserido com sucesso.');
				$this->redirect('/usuarios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('acoes', $this->Usuario->Acao->generateList(null,'ds_acao', null, '{n}.Acao.id', '{n}.Acao.ds_acao'));
				if(empty($this->data['Acao']['Acao'])) { $this->data['Acao']['Acao'] = null; }
				$this->set('selectedAcoes', $this->data['Acao']['Acao']);
				$this->set('acoesrelatorios', $this->Usuario->Acoesrelatorio->generateList());
				if(empty($this->data['Acoesrelatorio']['Acoesrelatorio'])) { $this->data['Acoesrelatorio']['Acoesrelatorio'] = null; }
				$this->set('selectedAcoesrelatorios', $this->data['Acoesrelatorio']['Acoesrelatorio']);
				$this->set('declaracoesescopos', $this->Usuario->Declaracoesescopo->generateList());
				if(empty($this->data['Declaracoesescopo']['Declaracoesescopo'])) { $this->data['Declaracoesescopo']['Declaracoesescopo'] = null; }
				$this->set('selectedDeclaracoesescopos', $this->data['Declaracoesescopo']['Declaracoesescopo']);
				$this->set('dicionarioseaps', $this->Usuario->Dicionarioseap->generateList());
				if(empty($this->data['Dicionarioseap']['Dicionarioseap'])) { $this->data['Dicionarioseap']['Dicionarioseap'] = null; }
				$this->set('selectedDicionarioseaps', $this->data['Dicionarioseap']['Dicionarioseap']);
				$this->set('estudosviabilidades', $this->Usuario->Estudosviabilidade->generateList());
				if(empty($this->data['Estudosviabilidade']['Estudosviabilidade'])) { $this->data['Estudosviabilidade']['Estudosviabilidade'] = null; }
				$this->set('selectedEstudosviabilidades', $this->data['Estudosviabilidade']['Estudosviabilidade']);
				$this->set('mapascomunicacoes', $this->Usuario->Mapascomunicacao->generateList());
				if(empty($this->data['Mapascomunicacao']['Mapascomunicacao'])) { $this->data['Mapascomunicacao']['Mapascomunicacao'] = null; }
				$this->set('selectedMapascomunicacoes', $this->data['Mapascomunicacao']['Mapascomunicacao']);
				$this->set('planosprojetos', $this->Usuario->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
				if(empty($this->data['Planosprojeto']['Planosprojeto'])) { $this->data['Planosprojeto']['Planosprojeto'] = null; }
				$this->set('selectedPlanosprojetos', $this->data['Planosprojeto']['Planosprojeto']);
				$this->set('termosaceitesprojetos', $this->Usuario->Termosaceitesprojeto->generateList());
				if(empty($this->data['Termosaceitesprojeto']['Termosaceitesprojeto'])) { $this->data['Termosaceitesprojeto']['Termosaceitesprojeto'] = null; }
				$this->set('selectedTermosaceitesprojetos', $this->data['Termosaceitesprojeto']['Termosaceitesprojeto']);
				$this->set('departamentos', $this->Usuario->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
			}
		}
	}

	function edit($id = null) {
      $this->pageTitle = 'Usuário';
	  $this->checkAcess();
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Usuario');
				$this->redirect('/usuarios/index');
			}
			$this->data = $this->Usuario->read(null, $id);
			$this->set('acoes', $this->Usuario->Acao->generateList(null,'ds_acao', null, '{n}.Acao.id', '{n}.Acao.ds_acao'));
			if(empty($this->data['Acao'])) { $this->data['Acao'] = null; }
			$this->set('selectedAcoes', $this->_selectedArray($this->data['Acao']));
			$this->set('acoesrelatorios', $this->Usuario->Acoesrelatorio->generateList());
			if(empty($this->data['Acoesrelatorio'])) { $this->data['Acoesrelatorio'] = null; }
			$this->set('selectedAcoesrelatorios', $this->_selectedArray($this->data['Acoesrelatorio']));
			$this->set('declaracoesescopos', $this->Usuario->Declaracoesescopo->generateList());
			if(empty($this->data['Declaracoesescopo'])) { $this->data['Declaracoesescopo'] = null; }
			$this->set('selectedDeclaracoesescopos', $this->_selectedArray($this->data['Declaracoesescopo']));
			$this->set('dicionarioseaps', $this->Usuario->Dicionarioseap->generateList());
			if(empty($this->data['Dicionarioseap'])) { $this->data['Dicionarioseap'] = null; }
			$this->set('selectedDicionarioseaps', $this->_selectedArray($this->data['Dicionarioseap']));
			$this->set('estudosviabilidades', $this->Usuario->Estudosviabilidade->generateList());
			if(empty($this->data['Estudosviabilidade'])) { $this->data['Estudosviabilidade'] = null; }
			$this->set('selectedEstudosviabilidades', $this->_selectedArray($this->data['Estudosviabilidade']));
			$this->set('mapascomunicacoes', $this->Usuario->Mapascomunicacao->generateList());
			if(empty($this->data['Mapascomunicacao'])) { $this->data['Mapascomunicacao'] = null; }
			$this->set('selectedMapascomunicacoes', $this->_selectedArray($this->data['Mapascomunicacao']));
			$this->set('planosprojetos', $this->Usuario->Planosprojeto->generateList(null,'ds_plano_projeto', null, '{n}.Planosprojeto.id', '{n}.Planosprojeto.ds_plano_projeto'));
			if(empty($this->data['Planosprojeto'])) { $this->data['Planosprojeto'] = null; }
			$this->set('selectedPlanosprojetos', $this->_selectedArray($this->data['Planosprojeto']));
			$this->set('termosaceitesprojetos', $this->Usuario->Termosaceitesprojeto->generateList());
			if(empty($this->data['Termosaceitesprojeto'])) { $this->data['Termosaceitesprojeto'] = null; }
			$this->set('selectedTermosaceitesprojetos', $this->_selectedArray($this->data['Termosaceitesprojeto']));
			$this->set('departamentos', $this->Usuario->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
		} else {
			$this->cleanUpFields();
			if($this->Usuario->save($this->data)) {
				$this->Session->setFlash('Usuário editado com sucesso.');
				$this->redirect('/usuarios/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('acoes', $this->Usuario->Acao->generateList(null,'ds_acao', null, '{n}.Acao.id', '{n}.Acao.ds_acao'));
				if(empty($this->data['Acao']['Acao'])) { $this->data['Acao']['Acao'] = null; }
				$this->set('selectedAcoes', $this->data['Acao']['Acao']);
				$this->set('acoesrelatorios', $this->Usuario->Acoesrelatorio->generateList());
				if(empty($this->data['Acoesrelatorio']['Acoesrelatorio'])) { $this->data['Acoesrelatorio']['Acoesrelatorio'] = null; }
				$this->set('selectedAcoesrelatorios', $this->data['Acoesrelatorio']['Acoesrelatorio']);
				$this->set('declaracoesescopos', $this->Usuario->Declaracoesescopo->generateList());
				if(empty($this->data['Declaracoesescopo']['Declaracoesescopo'])) { $this->data['Declaracoesescopo']['Declaracoesescopo'] = null; }
				$this->set('selectedDeclaracoesescopos', $this->data['Declaracoesescopo']['Declaracoesescopo']);
				$this->set('dicionarioseaps', $this->Usuario->Dicionarioseap->generateList());
				if(empty($this->data['Dicionarioseap']['Dicionarioseap'])) { $this->data['Dicionarioseap']['Dicionarioseap'] = null; }
				$this->set('selectedDicionarioseaps', $this->data['Dicionarioseap']['Dicionarioseap']);
				$this->set('estudosviabilidades', $this->Usuario->Estudosviabilidade->generateList());
				if(empty($this->data['Estudosviabilidade']['Estudosviabilidade'])) { $this->data['Estudosviabilidade']['Estudosviabilidade'] = null; }
				$this->set('selectedEstudosviabilidades', $this->data['Estudosviabilidade']['Estudosviabilidade']);
				$this->set('mapascomunicacoes', $this->Usuario->Mapascomunicacao->generateList());
				if(empty($this->data['Mapascomunicacao']['Mapascomunicacao'])) { $this->data['Mapascomunicacao']['Mapascomunicacao'] = null; }
				$this->set('selectedMapascomunicacoes', $this->data['Mapascomunicacao']['Mapascomunicacao']);
				$this->set('planosprojetos', $this->Usuario->Planosprojeto->generateList());
				if(empty($this->data['Planosprojeto']['Planosprojeto'])) { $this->data['Planosprojeto']['Planosprojeto'] = null; }
				$this->set('selectedPlanosprojetos', $this->data['Planosprojeto']['Planosprojeto']);
				$this->set('termosaceitesprojetos', $this->Usuario->Termosaceitesprojeto->generateList());
				if(empty($this->data['Termosaceitesprojeto']['Termosaceitesprojeto'])) { $this->data['Termosaceitesprojeto']['Termosaceitesprojeto'] = null; }
				$this->set('selectedTermosaceitesprojetos', $this->data['Termosaceitesprojeto']['Termosaceitesprojeto']);
				$this->set('departamentos', $this->Usuario->Departamento->generateList(null,'ds_departamento', null, '{n}.Departamento.id', '{n}.Departamento.ds_departamento'));
			}
		}
	}

	function delete($id = null) {
	  $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Usuario');
			$this->redirect('/usuarios/index');
		}
		if($this->Usuario->del($id)) {
			$this->Session->setFlash('Usuário Excluído: id '.$id.'');
			$this->redirect('/usuarios/index');
		}
	}

  function login()
    {
        $this->pageTitle = 'Login';
        if (!empty($this->data))
        {
            $someone = $this->Usuario->findByDs_usuario($this->data['Usuario']['ds_usuario']);

            if(!empty($someone['Usuario']['ds_senha']) && $someone['Usuario']['ds_senha'] == $this->data['Usuario']['ds_senha'] &&  $someone['Usuario']['ativo'] == 1)
            {
                $this->Session->write('Usuario', $this->data['Usuario']['ds_usuario']);
                $left = $this->Usuario->retornaLeft($_SESSION['Usuario']);
                $grupo = $this->Usuario->retornaGrupo($left);
                if ($grupo == 2){
                   $this->Session->write('Mapa','http://localhost/cake1.1/sicgpi/mapas/adm');
                   $this->redirect($_SESSION['Mapa']);
                }
                else if ($grupo == 3){
                   $this->Session->write('Mapa','http://localhost/cake1.1/sicgpi/mapas/gerente');
                   $this->redirect($_SESSION['Mapa']);
                }
                else if ($grupo == 4) {
                   $this->Session->write('Mapa','http://localhost/cake1.1/sicgpi/mapas/analista');
                   $this->redirect($_SESSION['Mapa']);
                }
                else if ($grupo == 5) {
                   $this->Session->write('Mapa','http://localhost/cake1.1/sicgpi/mapas/contabil');
                   $this->redirect($_SESSION['Mapa']);
                }
                else if ($grupo == 6) {
                   $this->Session->write('Mapa','http://localhost/cake1.1/sicgpi/mapas/patrocinador');
                   $this->redirect($_SESSION['Mapa']);
                }
            }
            else
            {
                $this->Session->setFlash('Os dados do seu usuário estão incorretos, tente novamente.');
            }
        }
    }

    function logout()
    {
        $this->Session->delete('Usuario');
        $this->Session->delete('Mapa');
        $this->redirect('/');
    }
}
?>
