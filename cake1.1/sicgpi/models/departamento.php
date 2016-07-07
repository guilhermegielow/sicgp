<?php
class Departamento extends AppModel {

	var $name = 'Departamento';
	var $validate = array(
		'ds_departamento' => VALID_NOT_EMPTY,
		'nr_centro_custo' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Usuario' =>
				array('className' => 'Usuario',
						'foreignKey' => 'departamento_id',
						'conditions' => '',
						'fields' => 'id, nm_usuario, ds_email',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);

	var $hasAndBelongsToMany = array(
			'Declaracoesescopo' =>
				array('className' => 'Declaracoesescopo',
						'joinTable' => 'declaracoesescopos_departamentos',
						'foreignKey' => 'departamento_id',
						'associationForeignKey' => 'declaracoesescopo_id',
						'conditions' => '',
						'fields' => 'id, ds_declaracao_escopo',
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
             if (!isset($this->data["Departamento"]["id"])){
             $this->data["Departamento"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Departamento"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
