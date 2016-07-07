<?php
class AnexosController extends AppController {

	var $name = 'Anexos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	    $this->pageTitle = 'Anexo';
        $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		$this->Anexo->recursive = 0;
		$this->set('anexos', $this->Anexo->findAll("Anexo.user_created = '$usuario'"));
	}

	function view($id = null) {
	    $this->pageTitle = 'Anexo';
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Anexo.');
			$this->redirect('/anexos/index');
		}
		$this->set('anexo', $this->Anexo->read(null, $id));
	}

	function add() {
	    $this->pageTitle = 'Anexo';
        $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
        $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
        if(empty($this->data)) {
			$this->set('projetos', $this->Anexo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			$this->render();
		} else {
			$this->cleanUpFields();
            $this->data['Anexo']['arq_anexo'] = $arquivo['name'];
			if($this->Anexo->save($this->data)) {
              //upload do arquivo
			  if(isset($this->data['Anexo']['arq_anexo'])) {
               //copiando o arquivo para o diretorio final
				copy( $arquivo['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'cake1.1/sicgpi/arquivos/'.(mysql_insert_id()) .$this->data['Anexo']['arq_anexo']);
              }
                $this->Session->setFlash('Anexo inserido com sucesso.');
				$this->redirect('/anexos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Anexo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function edit($id = null) {
	    $this->pageTitle = 'Anexo';
        $this->checkAcess();
        $usuario = $_SESSION['Usuario'];
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Anexo');
				$this->redirect('/anexos/index');
			}
			$this->data = $this->Anexo->read(null, $id);
			$this->set('projetos', $this->Anexo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
		} else {
			$this->cleanUpFields();
			if($this->Anexo->save($this->data)) {
				$this->Session->setFlash('Anexo editado com sucesso.');
				$this->redirect('/anexos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
				$this->set('projetos', $this->Anexo->Projeto->generateList("Projeto.user_created = '$usuario'",'id desc',null,'{n}.Projeto.id','{n}.Projeto.ds_titulo'));
			}
		}
	}

	function delete($id = null) {
        $this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Anexo');
			$this->redirect('/anexos/index');
		}
        $this->Anexo->id = $id;
        $dbEntry = $this->Anexo->read();
		if($this->Anexo->del($id)) {
            //exclui o arquivo fisicamente
            $file = $_SERVER['DOCUMENT_ROOT'].'cake1.1/sicgpi/arquivos/'.$id.$dbEntry['Anexo']['arq_anexo'];
            unlink($file);
            $this->Session->setFlash('Anexo Excluído: id '.$id);
			$this->redirect('/anexos/index');
		}
	}
	function download($id) {
             $this->checkAcess();
             $this->Anexo->id = $id;
             $dbEntry = $this->Anexo->read();
             $arquivo = $dbEntry['Anexo']['arq_anexo'];
             $file = $_SERVER['DOCUMENT_ROOT'].'cake1.1/sicgpi/arquivos/'.$id.$arquivo;
             $data = file_get_contents($file);
             $size = filesize($file);
             $extensao = strtolower(strrchr($arquivo, "."));
             switch ($extensao) {
                case "asf":
                        $ct = "video/x-ms-asf";
                        break;
                case "avi":
                        $ct = "video/avi";
                        break;
                case "doc":
                        $ct = "application/msword";
                        break;
                case "zip":
                        $ct = "application/zip";
                        break;
                case "css":
                        $ct = "text/css";
                        break;
                case "pdf":
                        $ct = "application/pdf";
                        break;
                case "xls":
                        $ct = "application/vnd.ms-excel";
                        break;
                case "gif":
                        $ct = "image/gif" ;
                        break;
                case "jpg" :
                        $ct = "image/jpeg";
                        break;
                case "jpeg":
                        $ct = "image/jpeg";
                        break;
                case "wav":
                        $ct = "audio/wav";
                        break;
                case "mp3":
                        $ct = "audio/mpeg3";
                        break;
                case "mpg":
                        $ct = "video/mpeg";
                        break;
                case "mpeg":
                        $ct = "video/mpeg";
                        break;
                case "rtf":
                        $ct = "application/rtf";
                        break;
                case "htm":
                        $ct = "text/html";
                        break;
                case "html":
                        $ct = "text/html";
                        break;
                case "asp":
                        $ct = "text/asp";
                        break;
                default:
                        $ct = "application/x-msdownload";
                        break;
             }
             header('Content-Type:'.$ct);
             header("Content-Length:".filesize($file));
             header('Content-Disposition: attachment; filename="' .$arquivo . '"');
             header("Content-Transfer-Encoding: binary");
             header('Expires: 0');
             header('Pragma: no-cache');
             // nesse momento ele le o arquivo e envia
             $fp = fopen("$file", "r");
             fpassthru($fp);
             fclose($fp);
             $this->Session->setFlash('Download do anexo com sucesso.');
             $this->redirect('/anexos/index');
        }

}
?>
