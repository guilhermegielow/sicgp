<?php
class Contascusto extends AppModel {

	var $name = 'Contascusto';
	var $validate = array(
		'tiposconta_id' => VALID_NOT_EMPTY,
		'vl_conta' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Tiposconta' =>
				array('className' => 'Tiposconta',
						'foreignKey' => 'tiposconta_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasAndBelongsToMany = array(
			'Estudosviabilidade' =>
				array('className' => 'Estudosviabilidade',
						'joinTable' => 'contascustos_estudosviabilidades',
						'foreignKey' => 'contascusto_id',
						'associationForeignKey' => 'estudosviabilidade_id',
						'conditions' => '',
						'fields' => 'id',
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
             if (!isset($this->data["Contascusto"]["id"])){
             $this->data["Contascusto"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Contascusto"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }

}
?>
