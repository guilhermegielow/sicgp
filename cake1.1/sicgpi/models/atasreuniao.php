<?php
class Atasreuniao extends AppModel {

	var $name = 'Atasreuniao';
	var $validate = array(
		'tiposreuniao_id' => VALID_NOT_EMPTY,
		'projeto_id' => VALID_NOT_EMPTY,
		'usuario_id' => VALID_NOT_EMPTY,
		'ds_ata_reuniao' => VALID_NOT_EMPTY,
		'nr_versão' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Tiposreuniao' =>
				array('className' => 'Tiposreuniao',
						'foreignKey' => 'tiposreuniao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Projeto' =>
				array('className' => 'Projeto',
						'foreignKey' => 'projeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array(
			'Acao' =>
				array('className' => 'Acao',
						'foreignKey' => 'atasreuniao_id',
						'conditions' => '',
						'fields' => 'id, ds_acao, dias_prazo',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Assuntostratado' =>
				array('className' => 'Assuntostratado',
						'foreignKey' => 'atasreuniao_id',
						'conditions' => '',
						'fields' => 'id, ds_assunto_tratado',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Decisao' =>
				array('className' => 'Decisao',
						'foreignKey' => 'atasreuniao_id',
						'conditions' => '',
						'fields' => 'id, ds_decisao',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Atasreuniao"]["id"])){
             $this->data["Atasreuniao"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Atasreuniao"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
