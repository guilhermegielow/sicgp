<?php
class Dicionarioseap extends AppModel {

	var $name = 'Dicionarioseap';
	var $validate = array(
		'atividade_id' => VALID_NOT_EMPTY,
		'projeto_id' => VALID_NOT_EMPTY,
		'tiposespecificacao_id' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Atividade' =>
				array('className' => 'Atividade',
						'foreignKey' => 'atividade_id',
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

			'Tiposespecificacao' =>
				array('className' => 'Tiposespecificacao',
						'foreignKey' => 'tiposespecificacao_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);


	var $hasAndBelongsToMany = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'joinTable' => 'dicionarioseaps_usuarios',
						'foreignKey' => 'dicionarioseap_id',
						'associationForeignKey' => 'usuario_id',
						'conditions' => '',
						'fields' => 'id, nm_usuario',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Dicionarioseap"]["id"])){
             $this->data["Dicionarioseap"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Dicionarioseap"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
