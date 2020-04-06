<?php

namespace Holos\Hcco\Mapper;

use Holos\Hcco\Entity\Hcco_Curriculo;

class Hcco_Curriculo_Mapper {

    /**
     * Table name in the database
     */
    private static $table = 'hcco_curriculo';

    /**
     * Get an object by id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    public static function fetch( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Curriculo( $result );

    }

    //
    public static function create( Hcco_Curriculo $curriculo ) {

        global $wpdb;

        $result = $wpdb->insert( $wpdb->prefix . self::$table, array(
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

        $wpdb->update( $wpdb->prefix . self::$table, array(
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

        $wpdb->delete( $wpdb->prefix . self::$table, array( 'id' => $id ) );
        
    }

}