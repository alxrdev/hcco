<?php

namespace Holos\Hcco\Mapper;

use Holos\Hcco\Entity\Hcco_Curriculo;

class Hcco_Curriculo_Mapper {

    /**
     * Table name in the database
     */
    private static $table_name = 'hcco_curriculo';

    /**
     * 
     */
    private static $ralation_table_name = 'hcco_pedidos';

    /**
     * Get an object by id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    public static function fetch( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table_name . " WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Curriculo( $result );

    }

    //
    public static function create( Hcco_Curriculo $curriculo ) {

        global $wpdb;

        $result = $wpdb->insert( $wpdb->prefix . self::$table_name, array(
            'nome'                              => $curriculo->get_nome(),
            'data_nascimento'                   => $curriculo->get_data_nascimento(),
            'sexo'                              => $curriculo->get_sexo(),
            'nacionalidade'                     => $curriculo->get_nacionalidade(),
            'estado_civil'                      => $curriculo->get_estado_civil(),
            'filhos'                            => $curriculo->get_filhos(),
            'empregado'                         => $curriculo->get_empregado(),
            'cnh'                               => $curriculo->get_cnh(),
            'cep'                               => $curriculo->get_cep(),
            'estado'                            => $curriculo->get_estado(),
            'cidade'                            => $curriculo->get_cidade(),
            'bairro'                            => $curriculo->get_bairro(),
            'endereco'                          => $curriculo->get_endereco(),
            'numero'                            => $curriculo->get_numero(),
            'telefone_1'                        => $curriculo->get_telefone_1(),
            'telefone_2'                        => $curriculo->get_telefone_2(),
            'email'                             => $curriculo->get_email(),
            'facebook'                          => $curriculo->get_facebook(),
            'instagram'                         => $curriculo->get_instagram(),
            'linkedin'                          => $curriculo->get_linkedin(),
            'escolaridade'                      => $curriculo->get_escolaridade(),
            'curso_formacao'                    => $curriculo->get_curso_formacao(),
            'cursos_e_treinamentos'             => $curriculo->get_cursos_e_treinamentos(),
            'empresa_1'                         => $curriculo->get_empresa_1(),
            'data_entrada_empresa_1'            => $curriculo->get_data_entrada_empresa_1(),
            'data_saida_empresa_1'              => $curriculo->get_data_saida_empresa_1(),
            'cargo_empresa_1'                   => $curriculo->get_cargo_empresa_1(),
            'atividades_exercidas_empresa_1'    => $curriculo->get_atividades_exercidas_empresa_1(),
            'empresa_2'                         => $curriculo->get_empresa_2(),
            'data_entrada_empresa_2'            => $curriculo->get_data_entrada_empresa_2(),
            'data_saida_empresa_2'              => $curriculo->get_data_saida_empresa_2(),
            'cargo_empresa_2'                   => $curriculo->get_cargo_empresa_2(),
            'atividades_exercidas_empresa_2'    => $curriculo->get_atividades_exercidas_empresa_2(),
            'empresa_3'                         => $curriculo->get_empresa_3(),
            'data_entrada_empresa_3'            => $curriculo->get_data_entrada_empresa_3(),
            'data_saida_empresa_3'              => $curriculo->get_data_saida_empresa_3(),
            'cargo_empresa_3'                   => $curriculo->get_cargo_empresa_3(),
            'atividades_exercidas_empresa_3'    => $curriculo->get_atividades_exercidas_empresa_3(),
            'cargos_profissoes'                 => $curriculo->get_cargos_profissoes(),
            'ramos_de_atividade'                => $curriculo->get_ramos_de_atividade(),
            'pretencao_salarial'                => $curriculo->get_pretencao_salarial(),
            'viagem'                            => $curriculo->get_viagem(),
            'morar_fora'                        => $curriculo->get_morar_fora()
        ) );

        $curriculo->set_id( $wpdb->insert_id );
        
        return $curriculo;

    }

    //
    public static function update( Hcco_Curriculo $curriculo ) {

        global $wpdb;

        $wpdb->update( $wpdb->prefix . self::$table_name, array(
            'nome'                              => $curriculo->get_nome(),
            'data_nascimento'                   => $curriculo->get_data_nascimento(),
            'sexo'                              => $curriculo->get_sexo(),
            'nacionalidade'                     => $curriculo->get_nacionalidade(),
            'estado_civil'                      => $curriculo->get_estado_civil(),
            'filhos'                            => $curriculo->get_filhos(),
            'empregado'                         => $curriculo->get_empregado(),
            'cnh'                               => $curriculo->get_cnh(),
            'cep'                               => $curriculo->get_cep(),
            'estado'                            => $curriculo->get_estado(),
            'cidade'                            => $curriculo->get_cidade(),
            'bairro'                            => $curriculo->get_bairro(),
            'endereco'                          => $curriculo->get_endereco(),
            'numero'                            => $curriculo->get_numero(),
            'telefone_1'                        => $curriculo->get_telefone_1(),
            'telefone_2'                        => $curriculo->get_telefone_2(),
            'email'                             => $curriculo->get_email(),
            'facebook'                          => $curriculo->get_facebook(),
            'instagram'                         => $curriculo->get_instagram(),
            'linkedin'                          => $curriculo->get_linkedin(),
            'escolaridade'                      => $curriculo->get_escolaridade(),
            'curso_formacao'                    => $curriculo->get_curso_formacao(),
            'cursos_e_treinamentos'             => $curriculo->get_cursos_e_treinamentos(),
            'empresa_1'                         => $curriculo->get_empresa_1(),
            'data_entrada_empresa_1'            => $curriculo->get_data_entrada_empresa_1(),
            'data_saida_empresa_1'              => $curriculo->get_data_saida_empresa_1(),
            'cargo_empresa_1'                   => $curriculo->get_cargo_empresa_1(),
            'atividades_exercidas_empresa_1'    => $curriculo->get_atividades_exercidas_empresa_1(),
            'empresa_2'                         => $curriculo->get_empresa_2(),
            'data_entrada_empresa_2'            => $curriculo->get_data_entrada_empresa_2(),
            'data_saida_empresa_2'              => $curriculo->get_data_saida_empresa_2(),
            'cargo_empresa_2'                   => $curriculo->get_cargo_empresa_2(),
            'atividades_exercidas_empresa_2'    => $curriculo->get_atividades_exercidas_empresa_2(),
            'empresa_3'                         => $curriculo->get_empresa_3(),
            'data_entrada_empresa_3'            => $curriculo->get_data_entrada_empresa_3(),
            'data_saida_empresa_3'              => $curriculo->get_data_saida_empresa_3(),
            'cargo_empresa_3'                   => $curriculo->get_cargo_empresa_3(),
            'atividades_exercidas_empresa_3'    => $curriculo->get_atividades_exercidas_empresa_3(),
            'cargos_profissoes'                 => $curriculo->get_cargos_profissoes(),
            'ramos_de_atividade'                => $curriculo->get_ramos_de_atividade(),
            'pretencao_salarial'                => $curriculo->get_pretencao_salarial(),
            'viagem'                            => $curriculo->get_viagem(),
            'morar_fora'                        => $curriculo->get_morar_fora()
        ), array( 'id' => $curriculo->get_id() ) );

        return $curriculo;
        
    }

    //
    public static function delete( $id ) {

        global $wpdb;

        $wpdb->delete( $wpdb->prefix . self::$table_name, array( 'id' => $id ) );
        
    }

    /**
     * Return all data.
     * 
     * @param string $search Search query.
     * @param string $order_by Name of column to roder data.
     * @param string $order Order method ( ASC, DESC ).
     * @param int $per_page Rows per page.
     * @param int $page_number Current page number.
     * 
     * @return mixed
     */
    public static function fetch_all_raw( $search = '', $order_by = '', $order = '', $per_page = 5, $page_number = 0 ) {

        global $wpdb;

        $sql = "
            SELECT 
                c.*, 
                p.status_pagamento as status_pagamento
            FROM 
                " . $wpdb->prefix . self::$table_name . " AS c
            INNER JOIN
                " . $wpdb->prefix . self::$ralation_table_name . " AS p
            ON
                c.id = p.curriculo_id
            ";

        // verifica se está pesquisando
        // if ( $search ) {
        //     $sql .= " WHERE concat(nome, cargos_profissoes, curso_formacao) LIKE '%{$search}%' AND status_pagamento = 'pago'";
        // } 
        // else {
        //     $sql .= " WHERE status_pagamento = 'pago'";
        // }
        if ( $search ) {
            $sql .= " WHERE concat(nome, cargos_profissoes, curso_formacao) LIKE '%{$search}%'";
        }

        // se estiver filtrando
        if ( ! empty( $order_by ) ) {
            $sql .= ' ORDER BY ' . $order_by;
            $sql .= ( ! empty( $order ) ) ? ' ' . $order : ' ASC';
        }

        $sql .= " LIMIT $per_page";

        $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

        $result = $wpdb->get_results( $sql, 'ARRAY_A' );

        return $result;

    }

}