<?php
class ProdutosServicosTermosaceitesprojeto extends AppModel {

	var $name = 'ProdutosServicosTermosaceitesprojeto';
	var $primaryKey = 'termosaceitesprojeto_id, produto_id, servico_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Termosaceitesprojeto' =>
				array('className' => 'Termosaceitesprojeto',
						'foreignKey' => 'termosaceitesprojeto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Produto' =>
				array('className' => 'Produto',
						'foreignKey' => 'produto_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Servico' =>
				array('className' => 'Servico',
						'foreignKey' => 'servico_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>