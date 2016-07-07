CREATE TABLE tiposatividades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_atividades VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null, 
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposcontas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_conta VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE contascustos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  tiposconta_id INTEGER  NOT NULL,
  vl_conta CHAR(8) NULL,
  ds_contacusto varchar(30)null,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(tiposconta_id)
    REFERENCES tiposcontas(id)      
)
TYPE = MyISAM;

CREATE TABLE tiposcomunicacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_comunicacao VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE prioridades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_prioridade VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE fornecedores (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  nm_fornecedor VARCHAR(60) NULL,
  ds_email VARCHAR(40) NULL,
  nr_cnpj CHAR (14)  NULL,
  nr_telefone INTEGER  NULL,
  nm_contato VARCHAR(40) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE departamentos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_departamento VARCHAR(50) NULL,
  nr_centro_custo INTEGER  NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE gruposrecursos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_grupo_recurso VARCHAR(50) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposreunioes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_reuniao VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposresponsabilidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_responsabilidade VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE unidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_unidade VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposservicos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_servico VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE estados (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_estado VARCHAR(50) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposespecificacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_especificacao VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;


CREATE TABLE atividades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id integer not null,
  cd_atividade_pai integer not null,
  tiposatividade_id INTEGER  NOT NULL,
  ds_atividade VARCHAR(50) NULL,
  vl_custo FLOAT(9,2) NULL,
  dias_prazo INTEGER NULL,
  vl_realizado FLOAT(9,2) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id),
  FOREIGN KEY(tiposatividade_id)
    REFERENCES tiposatividades(id)
      
  
)
TYPE = MyISAM;

CREATE TABLE tiposmudancas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_mudanca VARCHAR(40) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE tiposrecursosviabilidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  ds_tipo_recurso_viabilidade VARCHAR(50)  NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id)
)
TYPE = MyISAM;

CREATE TABLE usuarios (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  departamento_id INTEGER  NOT NULL,
  ds_usuario VARCHAR(100) NOT NULL,
  ds_senha VARCHAR(40) NOT NULL,
  nm_usuario VARCHAR(200) NOT NULL,
  ds_email VARCHAR(40) NOT NULL,
  dt_alt_senha DATE NOT NULL,
  prazo_senha INTEGER  NOT NULL,
  dt_fim_usuario DATE NOT NULL,
  ativo BOOL NULL,
  nr_telefone INTEGER  NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(departamento_id)
    REFERENCES departamentos(id)

      
)
TYPE = MyISAM;

CREATE TABLE projetos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estado_id INTEGER  NOT NULL,
  usuario_id integer not null,
  ds_titulo VARCHAR(100) NOT NULL,
  dt_prazo DATE NULL,
  dt_encerramento DATE NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,	
  PRIMARY KEY(id),
  FOREIGN KEY(estado_id)
    REFERENCES estados(id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE anexos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_anexo VARCHAR(200) NULL,
  arq_anexo VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE declaracoesescopos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_declaracao_escopo VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE cronogramas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE criteriosaceitacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_criterio_aceitacao VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE alteracoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  planosprojeto_id INTEGER  NOT NULL,
  ds_alteracao VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(planosprojeto_id)
    REFERENCES planosprojetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE licoesaprendidas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_licao_aprendida VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE planosprojetos_usuarios (
  usuario_id INTEGER  NOT NULL,
  planosprojeto_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, planosprojeto_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      ,
  FOREIGN KEY(planosprojeto_id)
    REFERENCES planosprojetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE estudosviabilidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  tiposservico_id INTEGER  NOT NULL,
  projeto_id INTEGER  NOT NULL,
  dt_inicio_validade DATE NULL,
  dt_fim_validade DATE NULL,
  ds_texto_encerramento VARCHAR(2000) NULL,
  dt_aprovacao DATE NULL,
  user_aprovacao varchar(20) null,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  log_envio_contabilidade bool null,
  log_classificado bool null,
  log_envio_patrocinador bool null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id),
  FOREIGN KEY(tiposservico_id)
    REFERENCES tiposservicos(id)      
)
TYPE = MyISAM;

CREATE TABLE contascustos_estudosviabilidades (
  contascusto_id INTEGER  NOT NULL,
  estudosviabilidade_id INTEGER  NOT NULL,
  PRIMARY KEY(contascusto_id, estudosviabilidade_id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)      
      ,
  FOREIGN KEY(contascusto_id)
    REFERENCES contascustos(id)      
)
TYPE = MyISAM;


CREATE TABLE estudosviabilidades_usuarios (
  usuario_id INTEGER  NOT NULL,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_responsabilidade VARCHAR(100) NULL,
  ds_interesse VARCHAR(100) NULL,
  PRIMARY KEY(usuario_id, estudosviabilidade_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      ,
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE declaracoesescopos_usuarios (
  usuario_id INTEGER  NOT NULL,
  declaracoesescopo_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, declaracoesescopo_id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      ,
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE recursos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  gruposrecurso_id INTEGER  NOT NULL,
  unidade_id INTEGER  NOT NULL,
  projeto_id integer not null,
  ds_recurso VARCHAR(80) NULL,
  vl_custo FLOAT(9,2) NULL,
  quantidade FLOAT(9,2) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(gruposrecurso_id)
    REFERENCES gruposrecursos(id),
  FOREIGN KEY(unidade_id)
    REFERENCES unidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE declaracoesescopos_departamentos (
  departamento_id INTEGER  NOT NULL,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_responsabilidade VARCHAR(60) NULL,
  PRIMARY KEY(departamento_id, declaracoesescopo_id),
  FOREIGN KEY(departamento_id)
    REFERENCES departamentos(id)
      
      ,
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE dicionarioseaps (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  atividade_id INTEGER  NOT NULL,
  projeto_id INTEGER  NOT NULL,
  tiposespecificacao_id INTEGER  NOT NULL,
  ds_descricao_eap VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      ,
  FOREIGN KEY(atividade_id)
    REFERENCES atividades(id),
  FOREIGN KEY(tiposespecificacao_id)
    REFERENCES tiposespecificacoes(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE controlesmudancas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  tiposmudanca_id INTEGER  NOT NULL,
  prioridade_id INTEGER  NOT NULL,
  ds_controle_mudanca VARCHAR(2000) NULL,
  ds_justificativa VARCHAR(2000) NULL,
  dt_prazo DATE NULL,
  ds_impacto VARCHAR(2000) NULL,
  dt_comunicacao DATE NULL,
  dt_envio_recursos DATE NULL,
  user_aprovacao varchar(20),
  dt_aprovacao date null,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  log_envio_patrocinador bool null,
  PRIMARY KEY(id),
  FOREIGN KEY(prioridade_id)
    REFERENCES prioridades(id)
      
      ,
  FOREIGN KEY(tiposmudanca_id)
    REFERENCES tiposmudancas(id)
      
      ,
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE atividades_cronogramas (
  cronograma_id INTEGER  NOT NULL,
  atividade_id INTEGER  NOT NULL,
  unidade_id INTEGER  NOT NULL,
  nr_periodo INTEGER  NULL,
  PRIMARY KEY(cronograma_id, atividade_id),
  FOREIGN KEY(atividade_id)
    REFERENCES atividades(id)
      
      ,
  FOREIGN KEY(cronograma_id)
    REFERENCES cronogramas(id)
      
      ,
  FOREIGN KEY(unidade_id)
    REFERENCES unidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE orcamentos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  vl_projeto FLOAT(9,2) NULL,
  vl_reserva FLOAT(9,2) NULL,
  vl_administracao FLOAT(9,2) NULL,
  vl_total FLOAT(9,2) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE planoscustos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_plano_custo VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE planoscomunicacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_plano_comunicacao VARCHAR(2000) NULL,
  ds_politicas VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE planosaquisicoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_plano_aquisicao VARCHAR(250) NULL,
  ds_documento_referencia VARCHAR(200) NULL,
  ds_avaliacao_fornecedores VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE planosprojetos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_plano_projeto VARCHAR(2000) NULL,
  nr_versao FLOAT(9,2) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
)
TYPE = MyISAM;

CREATE TABLE mensagens (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_mensagem TEXT NULL,
  dt_mensagem DATETIME NULL,
  enviado BOOL NULL,
  nm_envolvidos TEXT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE marcos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_marco VARCHAR(60) NULL,
  dt_entrega DATE NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE mapascomunicacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_assunto VARCHAR(100) NULL,
  tp_documento VARCHAR(100) NULL,
  tp_meio VARCHAR(100) NULL,
  dias_frequencia INTEGER  NULL,
  ds_acao_esperada VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE objetivos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_objetivo VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE oportunidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_oportunidade VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE obstaculoscriticos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_obstaculo_critico VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE objetivosescopos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_objetivo_escopo VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE restricoesescopos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_restricao_escopo VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE restricoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_restricao VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE requisitos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_requisito VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE servicos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_servico VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE termosaceitesprojetos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  user_aceite varchar(20) null,
  dt_aceite DATE NULL,
  ds_local VARCHAR(100) NULL,
  ds_resumo_projeto VARCHAR(2000) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  log_envio_patrocinador bool null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE servicosescopos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_servico_escopo VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE produtos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_produto VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE processosaquisicoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  planosaquisicao_id INTEGER  NOT NULL,
  fornecedor_id INTEGER  NOT NULL,
  vl_orcamento FLOAT(9,2) NULL,
  dias_prazo INTEGER NULL,
  ds_processo_aquisicao VARCHAR(2000) NULL,
  dt_aprovacao DATE NULL,
  user_aprovacao varchar(20) null, 
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  log_envio_patrocinador bool null,
  PRIMARY KEY(id),
  FOREIGN KEY(planosaquisicao_id)
    REFERENCES planosaquisicoes(id),
  FOREIGN KEY(fornecedor_id)
    REFERENCES fornecedores(id)    
)
TYPE = MyISAM;

CREATE TABLE premissas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_premissa VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE produtosescopos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_produto_escopo VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE relatoriosdesempenhos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  ds_relatorio_desempenho VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE recomendacoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_recomendacao VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE escoposnaoincluidos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_escopo_nao_incluido VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE elementoseaps (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  atividade_id INTEGER NOT NULL,
  vl_planejado FLOAT(9,2) NULL,
  vl_agregado FLOAT(9,2) NULL,
  vl_real FLOAT(9,2) NULL,
  vl_perc_concluido FLOAT(9,2) NULL,
  dt_planejada DATE NULL,
  dt_efetiva DATE NULL,
  dias_atraso INTEGER  NULL,
  user_solicitante varchar(20) not null,
  user_responsavel varchar(20) not null,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
    FOREIGN KEY(atividade_id)
    REFERENCES atividades(id)     
)
TYPE = MyISAM;


CREATE TABLE elementosrelatorios (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  relatoriosdesempenho_id INTEGER NOT NULL,
  ds_atividade varchar(100) not null,
  vl_planejado FLOAT(9,2) NULL,
  vl_real FLOAT(9,2) NULL,
  vl_perc_concluido FLOAT(3,2) NULL,
  dt_planejada DATE NULL,
  dt_efetiva DATE NULL,
  dias_atraso INTEGER  NULL,
  user_solicitante varchar(20) not null,
  user_responsavel varchar(20) not null,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
    FOREIGN KEY(relatoriosdesempenho_id)
    REFERENCES relatoriosdesempenhos(id)
     
)
TYPE = MyISAM;

CREATE TABLE estrategiasconducoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  declaracoesescopo_id INTEGER  NOT NULL,
  ds_estrategia_conducao VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(declaracoesescopo_id)
    REFERENCES declaracoesescopos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE justificativas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  ds_justificativa VARCHAR(40) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE acoesrelatorios (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  relatoriosdesempenho_id INTEGER  NOT NULL,
  ds_acao_relatorio VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(relatoriosdesempenho_id)
    REFERENCES relatoriosdesempenhos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE itensmelhoras (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_item_melhora VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE itenssucessos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_item_sucesso VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE fatorescriticos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_fator_critico VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE forcas (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  licoesaprendida_id INTEGER  NOT NULL,
  ds_forca VARCHAR(200) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(licoesaprendida_id)
    REFERENCES licoesaprendidas(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE responsabilidades (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  estudosviabilidade_id INTEGER  NOT NULL,
  tiposresponsabilidade_id INTEGER  NOT NULL,
  ds_responsabilidade VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(tiposresponsabilidade_id)
    REFERENCES tiposresponsabilidades(id)
      
      ,
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE atividades_orcamentos (
  orcamento_id INTEGER  NOT NULL,
  atividade_id INTEGER  NOT NULL,
  PRIMARY KEY(orcamento_id, atividade_id),
  FOREIGN KEY(atividade_id)
    REFERENCES atividades(id)
      
      ,
  FOREIGN KEY(orcamento_id)
    REFERENCES orcamentos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE acoesrelatorios_usuarios (
  acoesrelatorio_id INTEGER  NOT NULL,
  usuario_id INTEGER  NOT NULL,
  PRIMARY KEY(acoesrelatorio_id, usuario_id),
  FOREIGN KEY(acoesrelatorio_id)
    REFERENCES acoesrelatorios(id)
      
      ,
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE termosaceitesprojetos_usuarios (
  usuario_id INTEGER  NOT NULL,
  termosaceitesprojeto_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, termosaceitesprojeto_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      ,
  FOREIGN KEY(termosaceitesprojeto_id)
    REFERENCES termosaceitesprojetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE dicionarioseaps_usuarios (
  usuario_id INTEGER  NOT NULL,
  dicionarioseap_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, dicionarioseap_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      ,
  FOREIGN KEY(dicionarioseap_id)
    REFERENCES dicionarioseaps(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE orcamentos_recursos (
  recurso_id INTEGER  NOT NULL,
  orcamento_id INTEGER  NOT NULL,
  PRIMARY KEY(recurso_id, orcamento_id),
  FOREIGN KEY(recurso_id)
    REFERENCES recursos(id)
      
      ,
  FOREIGN KEY(orcamento_id)
    REFERENCES orcamentos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE atasreunioes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  tiposreuniao_id INTEGER  NOT NULL,
  projeto_id INTEGER  NOT NULL,
  ds_ata_reuniao VARCHAR(100) NULL,
  nr_versao FLOAT(9,2) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(tiposreuniao_id)
    REFERENCES tiposreunioes(id)    
      ,
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE mapascomunicacoes_usuarios (
  usuario_id INTEGER  NOT NULL,
  mapascomunicacao_id INTEGER  NOT NULL,
  tiposcomunicacao_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, mapascomunicacao_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id)
      
      ,
  FOREIGN KEY(mapascomunicacao_id)
    REFERENCES mapascomunicacoes(id)
      
      ,
  FOREIGN KEY(tiposcomunicacao_id)
    REFERENCES tiposcomunicacoes(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE atividades_estudosviabilidades_recursos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  recurso_id INTEGER  NOT NULL,
  estudosviabilidade_id INTEGER  NOT NULL,
  atividade_id INTEGER  NOT NULL,
  tiposrecursosviabilidade_id INTEGER  NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(recurso_id)
    REFERENCES recursos(id)
      
      ,
  FOREIGN KEY(atividade_id)
    REFERENCES atividades(id)
      
      ,    
  FOREIGN KEY(estudosviabilidade_id)
    REFERENCES estudosviabilidades(id)
      
      ,
  FOREIGN KEY(tiposrecursosviabilidade_id)
    REFERENCES tiposrecursosviabilidades(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE assuntostratados (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  atasreuniao_id INTEGER  NOT NULL,
  ds_assunto_tratado VARCHAR(60) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(atasreuniao_id)
    REFERENCES atasreunioes(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE decisoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  atasreuniao_id INTEGER  NOT NULL,
  ds_decisao VARCHAR(100) NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(atasreuniao_id)
    REFERENCES atasreunioes(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE acoes (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  atasreuniao_id INTEGER  NOT NULL,
  ds_acao VARCHAR(100) NULL,
  dias_prazo INTEGER NULL,
  created datetime null,
  modified datetime null,
  user_created varchar(20) null,
  user_modified varchar(20) null,
  PRIMARY KEY(id),
  FOREIGN KEY(atasreuniao_id)
    REFERENCES atasreunioes(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE produtos_servicos_termosaceitesprojetos (
  id integer not null,
  termosaceitesprojeto_id INTEGER  NOT NULL,
  produto_id INTEGER  NOT NULL,
  servico_id INTEGER  NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(produto_id)
    REFERENCES produtos(id)
      
      ,
  FOREIGN KEY(servico_id)
    REFERENCES servicos(id)
      
      ,
  FOREIGN KEY(termosaceitesprojeto_id)
    REFERENCES termosaceitesprojetos(id)
      
      
)
TYPE = MyISAM;

CREATE TABLE acoes_usuarios (
  usuario_id INTEGER  NOT NULL,
  acao_id INTEGER  NOT NULL,
  PRIMARY KEY(usuario_id, acao_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id),
  FOREIGN KEY(acao_id)
    REFERENCES acoes(id)    
)
TYPE = MyISAM;

CREATE TABLE historicos (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  projeto_id INTEGER  NOT NULL,
  usuario_id INTEGER  NOT NULL,
  ds_historico VARCHAR(2000), 	
  PRIMARY KEY(id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuarios(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)      
)
TYPE = MyISAM;

CREATE TABLE acos (
    id             integer NOT NULL AUTO_INCREMENT,
    object_id     integer  NULL,
    alias          varchar(255) NOT NULL ,
    lft            integer  NULL,
    rght        integer  NULL,
    PRIMARY KEY(id)
) TYPE = MyISAM;

CREATE TABLE aros (
    id integer NOT NULL AUTO_INCREMENT,
    foreign_key integer  NULL,
    alias      varchar(255) NOT NULL,
    lft        integer  NULL,
    rght    integer  NULL,
    PRIMARY KEY(id)
)TYPE = MyISAM;

CREATE TABLE aros_acos (
    id integer NOT NULL AUTO_INCREMENT,
    aro_id integer  NULL,
    aco_id    integer  NULL,
    _create    integer NOT NULL,
    _read    integer NOT NULL,
    _update    integer NOT NULL,
    _delete    integer NOT NULL,
    PRIMARY KEY(id)  
)TYPE = MyISAM;

CREATE TABLE passosworkflows (
    id integer NOT NULL AUTO_INCREMENT,
    projeto_id INTEGER  NOT NULL,
    nr_passo INTEGER  NOT NULL,
    ds_passo varchar(30)  NOT NULL,
    user_responsavel varchar(100) NOT NULL,
    mensagem_inicial varchar(2000) NOT NULL,
    mensagem_expirada varchar(2000) NOT NULL,
    nr_passo_aprovado INTEGER  NOT NULL,
    dt_ultima_expiracao datetime null,
    hr_expiracao INTEGER  NOT NULL,
    dt_termino datetime null,     
    PRIMARY KEY(id),
  FOREIGN KEY(projeto_id)
    REFERENCES projetos(id)  
)TYPE = MyISAM;



