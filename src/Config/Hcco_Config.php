<?php

namespace Holos\Hcco\Config;

class Hcco_Config {

    /**
     * 
     */
    public static function activate() {

        global $wpdb;
		global $jal_db_version;

		$hcco_configuracoes = $wpdb->prefix . 'hcco_configuracoes';
		$hcco_curriculo = $wpdb->prefix . 'hcco_curriculo';
		$hcco_pedidos = $wpdb->prefix . 'hcco_pedidos';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $hcco_configuracoes (
			id int(11) auto_increment,
			preco decimal(11,2) NOT NULL,
			mercado_pago_sandbox_public_token varchar(255),
			mercado_pago_sandbox_private_token varchar(255),
			mercado_pago_production_public_token varchar(255),
			mercado_pago_production_private_token varchar(255),
			mercado_pago_ambiente varchar(255)
			PRIMARY KEY  (id)
		) $charset_collate;
		CREATE TABLE $hcco_curriculo (
			id int(11) auto_increment,
			nome varchar(255) NOT NULL,
			data_nascimento date NOT NULL,
			sexo varchar(255) NOT NULL,
			nacionalidade varchar(255) NOT NULL,
			estado_civil varchar(255) NOT NULL,
			filhos varchar(255) NOT NULL,
			empregado varchar(255) NOT NULL,
			cnh varchar(255) NOT NULL,
			cep varchar(255) NOT NULL,
			estado varchar(255) NOT NULL,
			cidade varchar(255) NOT NULL,
			bairro varchar(255) NOT NULL,
			endereco varchar(255) NOT NULL,
			numero varchar(255),
			telefone_1 varchar(255) NOT NULL,
			telefone_2 varchar(255),
			email varchar(255) NOT NULL,
			facebook varchar(255),
			instagram varchar(255),
			linkedin varchar(255),
			escolaridade varchar(255) NOT NULL,
			curso_formacao varchar(255),
			cursos_e_treinamentos varchar(255),
			empresa_1 varchar(255),
			data_entrada_empresa_1 date,
			data_saida_empresa_1 date,
			cargo_empresa_1 varchar(255),
			atividades_exercidas_empresa_1 tinytext,
			empresa_2 varchar(255),
			data_entrada_empresa_2 date,
			data_saida_empresa_2 date,
			cargo_empresa_2 varchar(255),
			atividades_exercidas_empresa_2 tinytext,
			empresa_3 varchar(255),
			data_entrada_empresa_3 date,
			data_saida_empresa_3 date,
			cargo_empresa_3 varchar(255),
			atividades_exercidas_empresa_3 tinytext,
			cargos_profissoes tinytext NOT NULL,
			ramos_de_atividade tinytext NOT NULL,
			pretencao_salarial varchar(255) NOT NULL,
			viagem varchar(255) NOT NULL,
			morar_fora varchar(255) NOT NULL,
			criado_em datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;
		CREATE TABLE $hcco_pedidos (
			id int(11) auto_increment,
			curriculo_id int(11) NOT NULL,
			usuario_id varchar(255) NOT NULL,
			codigo_referencia varchar(255) NOT NULL,
			preco decimal(11,2) NOT NULL,
			status_pagamento varchar(255) NOT NULL,
			criado_em datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			atualizado_em datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			PRIMARY KEY  (id),
			KEY (usuario_id),
			FOREIGN KEY (curriculo_id) REFERENCES $hcco_curriculo (id) ON DELETE CASCADE
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

        add_option( 'jal_db_version', $jal_db_version );
        
    }

    /**
     * 
     */
    public static function deactivate() {}

}