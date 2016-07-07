<?php
class Itensmelhora extends AppModel {

	var $name = 'Itensmelhora';
	var $validate = array(
		'licoesaprendida_id' => VALID_NOT_EMPTY,
		'ds_item_melhora' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Licoesaprendida' =>
				array('className' => 'Licoesaprendida',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	function beforeSave(){
             if (!isset($this->data["Itensmelhora"]["id"])){
             $this->data["Itensmelhora"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Itensmelhora"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
