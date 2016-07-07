<?php
class Licoesaprendida extends AppModel {

	var $name = 'Licoesaprendida';
	var $validate = array(
		'projeto_id' => VALID_NOT_EMPTY,
		'ds_licao_aprendida' => VALID_NOT_EMPTY,
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

	var $hasMany = array(
			'Fatorescritico' =>
				array('className' => 'Fatorescritico',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_fator_critico',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Forca' =>
				array('className' => 'Forca',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_forca',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Itensmelhora' =>
				array('className' => 'Itensmelhora',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_item_melhora',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Itenssucesso' =>
				array('className' => 'Itenssucesso',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_item_sucesso',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Obstaculoscritico' =>
				array('className' => 'Obstaculoscritico',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_obstaculo_critico',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Oportunidade' =>
				array('className' => 'Oportunidade',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_oportunidade',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'Recomendacao' =>
				array('className' => 'Recomendacao',
						'foreignKey' => 'licoesaprendida_id',
						'conditions' => '',
						'fields' => 'id, ds_recomendacao',
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
             if (!isset($this->data["Licoesaprendida"]["id"])){
             $this->data["Licoesaprendida"]["user_created"] = $_SESSION['Usuario'];
             }
             $this->data["Licoesaprendida"]["user_modified"] = $_SESSION['Usuario'];
             return true;
    }
}
?>
