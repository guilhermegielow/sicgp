<?php
class Mensagem extends AppModel {

	var $name = 'Mensagem';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_mensagem' => VALID_NOT_EMPTY,
		'nm_envolvidos' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function lePendentes()
	{
      $mensagens = $this->query("SELECT ds_mensagem, nm_envolvidos, id, projeto_id FROM mensagens WHERE enviado < 1");
      return $mensagens;
    }
	function beforeSave(){
             if (!isset($this->data["Mensagem"]["id"])){
             $this->data["Mensagem"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Mensagem"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
