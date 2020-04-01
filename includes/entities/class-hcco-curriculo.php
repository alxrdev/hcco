<?php

class Hcco_Curriculo extends Hcco_Entity {

    /*
     * Class properties
     */
    protected $data = array(
        'id'                                => '',
        'nome'                              => '',
        'data_nascimento'                   => '',
        'sexo'                              => '',
        'nacionalidade'                     => '',
        'estado_civil'                      => '',
        'filhos'                            => '',
        'empregado'                         => '',
        'cnh'                               => '',
        'cep'                               => '',
        'estado'                            => '',
        'cidade'                            => '',
        'bairro'                            => '',
        'endereco'                          => '',
        'numero'                            => '',
        'telefone_1'                        => '',
        'telefone_2'                        => '',
        'email'                             => '',
        'facebook'                          => '',
        'instagram'                         => '',
        'linkedin'                          => '',
        'escolaridade'                      => '',
        'curso_formacao'                    => '',
        'cursos_e_treinamentos'             => '',
        'empresa_1'                         => '',
        'data_entrada_empresa_1'            => '',
        'data_saida_empresa_1'              => '',
        'cargo_empresa_1'                   => '',
        'atividades_exercidas_empresa_1'    => '',
        'empresa_2'                         => '',
        'data_entrada_empresa_2'            => '',
        'data_saida_empresa_2'              => '',
        'cargo_empresa_2'                   => '',
        'atividades_exercidas_empresa_2'    => '',
        'empresa_3'                         => '',
        'data_entrada_empresa_3'            => '',
        'data_saida_empresa_3'              => '',
        'cargo_empresa_3'                   => '',
        'atividades_exercidas_empresa_3'    => '',
        'cargos_profissoes'                 => '',
        'ramos_de_atividade'                => '',
        'pretencao_salarial'                => '',
        'viagem'                            => '',
        'morar_fora'                        => '',
        'criado_em'                         => '',
    );

    /**
     * Required properties
     */
	protected $required_properties = [ 'nome', 'data_nascimento', 'sexo', 'nacionalidade', 'estado_civil', 'filhos', 'empregado', 'cnh', 'cep', 'estado', 'cidade', 'bairro', 'endereco', 'telefone_1', 'email', 'escolaridade', 'cargos_profissoes', 'ramos_de_atividade', 'pretencao_salarial', 'viagem', 'morar_fora' ];

    /**
     * Table name in the database
     */
    protected $table = 'wp_hcco_curriculo';

    /*
    |--------------------------------------------------------------------------
    | CRUD operators
    |--------------------------------------------------------------------------
    */

    /**
     * Get an object by id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    public function get_by_id( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM {$this->table} WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        $this->read( $result );

    }

    /**
     * Save the object in the database
     *
     */
    public function save() {

        if ( ( $this->get_id() != null ) && ( ! empty( $this->get_id() ) ) ) {
            $this->update();
        } else {
            $this->create();
        }

    }

    //
    protected function create() {

        global $wpdb;

        $this->set_prop( 'criado_em', current_time( 'yy/m/d h:m:s' ) );

        $result = $wpdb->insert( $this->table, $this->data );

        $this->set_id( $wpdb->insert_id );

    }

    //
    protected function update() {

        global $wpdb;

        $wpdb->update( $this->table, $this->data, array( 'id' => $this->get_id() ) );

    }

    //
    public function delete() {

        global $wpdb;

        $wpdb->delete( $this->table, array( 'id' => $this->get_id() ) );
        
    }

    /*
    |--------------------------------------------------------------------------
    | GETTERS AND SETTERS methods
    |--------------------------------------------------------------------------
    */

    public function get_id() {

        return $this->get_prop( 'id' );

    }

    protected function set_id( $id ) {

        $this->set_prop( 'id', $id );

    }

    public function get_nome() {

        return $this->get_prop( 'nome' );

    }

    public function set_nome( $nome ) {

        $this->set_prop( 'nome', $nome );

    }

    public function get_data_nascimento() {

        return $this->get_prop( 'data_nascimento' );

    }

    public function set_data_nascimento( $data_nascimento ) {

        $this->set_prop( 'data_nascimento', $data_nascimento );

    }

    public function get_sexo() {

        return $this->get_prop( 'sexo' );

    }

    public function set_sexo( $sexo ) {

        $sexo_list = array( 'masculino', 'feminino' );
        if ( in_array( $sexo , $sexo_list ) )
            $this->set_prop( 'sexo', $sexo );

    }

    public function get_nacionalidade() {

        return $this->get_prop( 'nacionalidade' );

    }

    public function set_nacionalidade( $nacionalidade ) {

        $nacionalidade_list = array( 'Afegão', 'Sul-africano', 'Alemão', 'Angolano', 'Saudita', 'Argelino', 'Argentino', 'Armênio', 'Australiano', 'Austríaco', 'Azerbaijano', 'Bangladês', 'Belga', 'Boliviano', 'Brasileiro', 'Búlgaro', 'Cabo-verdense', 'Camaronês', 'Cambojano', 'Canadense', 'Tcheco', 'Chileno', 'Chinês', 'Colombiano', 'Norte-coreano', 'Sul-coreano', 'Costa-marfinense', 'Costa-riquenho', 'Croata', 'Cubano', 'Dinamarquês', 'Dominicano', 'Egípcio', 'Equatoriano', 'Eslovaco', 'Esloveno', 'Espanhol', 'Norte-americano', 'Estoniano', 'Etíope', 'Filipino', 'Finlandês', 'Franês', 'Ganense', 'Georgiano', 'Grego', 'Groenlandês', 'Guatemalteco', 'Guineano', 'Haitiano', 'Hondurenho', 'Húngaro', 'Indiano', 'Indonésio', 'Iraniano', 'Iraquiano', 'Irlandês', 'Islandês', 'Israelense', 'Italiano', 'Jamaicano', 'Japonês', 'Kuwaitiano', 'Letão', 'Libanês', 'Líbio', 'Lituano', 'Macedônio', 'Malaio', 'Marroquino', 'Mexicano', 'Moçambicano', 'Mongol', 'Nepalês', 'Nicaraguense', 'Nigeriano', 'Norueguês', 'Neozelandês', 'Palestino', 'Panamenho', 'Paquistanês', 'Paraguaio', 'Peruano', 'Polinésio', 'Polonês', 'Port-riquenho', 'Português', 'Queniano', 'Britânico', 'Escocês', 'Inglês', 'Romeno', 'Russo', 'Senegalês', 'Serra-leonês', 'Sérvio', 'Cingapuriano', 'Sírio', 'Somali', 'Sueco', 'Suíço', 'Surinamês', 'Tailandês', 'Taiwanês', 'Togolês', 'Tunisiano', 'Turco', 'Ucraniano', 'Ugandense', 'Uruguaio', 'Venezuelano', 'Vietnamita', 'Zambiano', 'Zimbabuano' );
        if ( in_array( $nacionalidade , $nacionalidade_list ) )
            $this->set_prop( 'nacionalidade', $nacionalidade );

    }

    public function get_estado_civil() {

        return $this->get_prop( 'estado_civil' );

    }

    public function set_estado_civil( $estado_civil ) {

        $estado_civil_list = array( 'Solteiro', 'Casado', 'Divorciado', 'Separado', 'Amasiado', 'Viúvo' );
        if ( in_array( $estado_civil , $estado_civil_list ) )
            $this->set_prop( 'estado_civil', $estado_civil );

    }

    public function get_filhos() {

        return $this->get_prop( 'filhos' );

    }

    public function set_filhos( $filhos ) {

        $filhos_list = array( 'Sim', 'Não' );
        if ( in_array( $filhos , $filhos_list ) )
            $this->set_prop( 'filhos', $filhos );

    }

    public function get_empregado() {

        return $this->get_prop( 'empregado' );

    }

    public function set_empregado( $empregado ) {

        $empregado_list = array( 'Sim', 'Não' );
        if ( in_array( $empregado , $empregado_list ) )
            $this->set_prop( 'empregado', $empregado );

    }

    public function get_cnh() {

        return $this->get_prop( 'cnh' );

    }

    public function set_cnh( $cnh ) {

        $cnh_list = array( 'Não', 'a', 'b', 'ab', 'c', 'd', 'e' );
        if ( in_array( $cnh , $cnh_list ) )
            $this->set_prop( 'cnh', $cnh );

    }

    public function get_cep() {

        return $this->get_prop( 'cep' );

    }

    public function set_cep( $cep ) {

        $this->set_prop( 'cep', $cep );

    }

    public function get_estado() {

        return $this->get_prop( 'estado' );

    }

    public function set_estado( $estado ) {

        $this->set_prop( 'estado', strtoupper( $estado ) );

    }

    public function get_cidade() {

        return $this->get_prop( 'cidade' );

    }

    public function set_cidade( $cidade ) {

        $this->set_prop( 'cidade', $cidade );

    }

    public function get_bairro() {

        return $this->get_prop( 'bairro' );

    }

    public function set_bairro( $bairro ) {

        $this->set_prop( 'bairro', $bairro );

    }

    public function get_endereco() {

        return $this->get_prop( 'endereco' );

    }

    public function set_endereco( $endereco ) {

        $this->set_prop( 'endereco', $endereco );

    }

    public function get_numero() {

        return $this->get_prop( 'numero' );

    }

    public function set_numero( $numero ) {

        $this->set_prop( 'numero', $numero );

    }

    public function get_telefone_1() {

        return $this->get_prop( 'telefone_1' );

    }

    public function set_telefone_1( $telefone_1 ) {

        $this->set_prop( 'telefone_1', $telefone_1 );

    }

    public function get_telefone_2() {

        return $this->get_prop( 'telefone_2' );

    }

    public function set_telefone_2( $telefone_2 ) {

        $this->set_prop( 'telefone_2', $telefone_2 );

    }

    public function get_email() {

        return $this->get_prop( 'email' );

    }

    public function set_email( $email ) {

        $this->set_prop( 'email', $email );

    }

    public function get_facebook() {

        return $this->get_prop( 'facebook' );

    }

    public function set_facebook( $facebook ) {

        $this->set_prop( 'facebook', $facebook );

    }

    public function get_instagram() {

        return $this->get_prop( 'instagram' );

    }

    public function set_instagram( $instagram ) {

        $this->set_prop( 'instagram', $instagram );

    }

    public function get_linkedin() {

        return $this->get_prop( 'linkedin' );

    }

    public function set_linkedin( $linkedin ) {

        $this->set_prop( 'linkedin', $linkedin );

    }

    public function get_escolaridade() {

        return $this->get_prop( 'escolaridade' );

    }

    public function set_escolaridade( $escolaridade ) {

        $escolaridade_list = array( 'Doutorado Completo', 'Doutorado Incompleto', 'Mestrado Completo', 'Mestrado Incompleto', 'Pós-graduação Completa', 'Pós-graduação Incompleta', 'Superior Completo', 'Superior Incompleto', 'Curso Técnico Completo', 'Curso Técnico Incompleto', 'Ensino Médio Completo', 'Ensino Médio Incompleto', 'Ensino Fundamental Completo', 'Ensino Fundamental Incompleto', 'Não Alfabetizado' );
        if ( in_array( $escolaridade, $escolaridade_list ) )
            $this->set_prop( 'escolaridade', $escolaridade );

    }

    public function get_curso_formacao() {

        return $this->get_prop( 'curso_formacao' );

    }

    public function set_curso_formacao( $curso_formacao ) {

        $this->set_prop( 'curso_formacao', $curso_formacao );

    }

    public function get_cursos_e_treinamentos() {

        return $this->get_prop( 'cursos_e_treinamentos' );

    }

    public function set_cursos_e_treinamentos( $cursos_e_treinamentos ) {

        $this->set_prop( 'cursos_e_treinamentos', $cursos_e_treinamentos );

    }

    public function get_empresa_1() {

        return $this->get_prop( 'empresa_1' );

    }

    public function set_empresa_1( $empresa_1 ) {

        $this->set_prop( 'empresa_1', $empresa_1 );

    }

    public function get_data_entrada_empresa_1() {

        return $this->get_prop( 'data_entrada_empresa_1' );

    }

    public function set_data_entrada_empresa_1( $data_entrada_empresa_1 ) {

        $this->set_prop( 'data_entrada_empresa_1', $data_entrada_empresa_1 );

    }

    public function get_data_saida_empresa_1() {

        return $this->get_prop( 'data_saida_empresa_1' );

    }

    public function set_data_saida_empresa_1( $data_saida_empresa_1 ) {

        $this->set_prop( 'data_saida_empresa_1', $data_saida_empresa_1 );

    }

    public function get_cargo_empresa_1() {

        return $this->get_prop( 'cargo_empresa_1' );

    }

    public function set_cargo_empresa_1( $cargo_empresa_1 ) {

        $this->set_prop( 'cargo_empresa_1', $cargo_empresa_1 );

    }

    public function get_atividades_exercidas_empresa_1() {

        return $this->get_prop( 'atividades_exercidas_empresa_1' );

    }

    public function set_atividades_exercidas_empresa_1( $atividades_exercidas_empresa_1 ) {

        $this->set_prop( 'atividades_exercidas_empresa_1', $atividades_exercidas_empresa_1 );

    }

    public function get_empresa_2() {

        return $this->get_prop( 'empresa_2' );

    }

    public function set_empresa_2( $empresa_2 ) {

        $this->set_prop( 'empresa_2', $empresa_2 );

    }

    public function get_data_entrada_empresa_2() {

        return $this->get_prop( 'data_entrada_empresa_2' );

    }

    public function set_data_entrada_empresa_2( $data_entrada_empresa_2 ) {

        $this->set_prop( 'data_entrada_empresa_2', $data_entrada_empresa_2 );

    }

    public function get_data_saida_empresa_2() {

        return $this->get_prop( 'data_saida_empresa_2' );

    }

    public function set_data_saida_empresa_2( $data_saida_empresa_2 ) {

        $this->set_prop( 'data_saida_empresa_2', $data_saida_empresa_2 );

    }

    public function get_cargo_empresa_2() {

        return $this->get_prop( 'cargo_empresa_2' );

    }

    public function set_cargo_empresa_2( $cargo_empresa_2 ) {

        $this->set_prop( 'cargo_empresa_2', $cargo_empresa_2 );

    }

    public function get_atividades_exercidas_empresa_2() {

        return $this->get_prop( 'atividades_exercidas_empresa_2' );

    }

    public function set_atividades_exercidas_empresa_2( $atividades_exercidas_empresa_2 ) {

        $this->set_prop( 'atividades_exercidas_empresa_2', $atividades_exercidas_empresa_2 );

    }

    public function get_empresa_3() {

        return $this->get_prop( 'empresa_3' );

    }

    public function set_empresa_3( $empresa_3 ) {

        $this->set_prop( 'empresa_3', $empresa_3 );

    }

    public function get_data_entrada_empresa_3() {

        return $this->get_prop( 'data_entrada_empresa_3' );

    }

    public function set_data_entrada_empresa_3( $data_entrada_empresa_3 ) {

        $this->set_prop( 'data_entrada_empresa_3', $data_entrada_empresa_3 );

    }

    public function get_data_saida_empresa_3() {

        return $this->get_prop( 'data_saida_empresa_3' );

    }

    public function set_data_saida_empresa_3( $data_saida_empresa_3 ) {

        $this->set_prop( 'data_saida_empresa_3', $data_saida_empresa_3 );

    }

    public function get_cargo_empresa_3() {

        return $this->get_prop( 'cargo_empresa_3' );

    }

    public function set_cargo_empresa_3( $cargo_empresa_3 ) {

        $this->set_prop( 'cargo_empresa_3', $cargo_empresa_3 );

    }

    public function get_atividades_exercidas_empresa_3() {

        return $this->get_prop( 'atividades_exercidas_empresa_3' );

    }

    public function set_atividades_exercidas_empresa_3( $atividades_exercidas_empresa_3 ) {

        $this->set_prop( 'atividades_exercidas_empresa_3', $atividades_exercidas_empresa_3 );

    }

    public function get_cargos_profissoes() {

        return $this->get_prop( 'cargos_profissoes' );

    }

    public function set_cargos_profissoes( $cargos_profissoes ) {

        $this->set_prop( 'cargos_profissoes', $cargos_profissoes );

    }

    public function get_ramos_de_atividade() {

        return $this->get_prop( 'ramos_de_atividade' );

    }

    public function set_ramos_de_atividade( $ramos_de_atividade ) {

        $this->set_prop( 'ramos_de_atividade', $ramos_de_atividade );

    }

    public function get_pretencao_salarial() {

        return $this->get_prop( 'pretencao_salarial' );

    }

    public function set_pretencao_salarial( $pretencao_salarial ) {

        $pretencao_salarial_list = array( 'A combinar', 'Até R$ 1000.00', 'A partir de R$ 1000.00', 'A partir de R$ 2000.00', 'A partir de R$ 3000.00', 'A partir de R$ 4000.00', 'A partir de R$ 5000.00', 'A partir de R$ 6000.00' );
        if ( in_array( $pretencao_salarial , $pretencao_salarial_list ) )
            $this->set_prop( 'pretencao_salarial', $pretencao_salarial );

    }

    public function get_viagem() {

        return $this->get_prop( 'viagem' );

    }

    public function set_viagem( $viagem ) {

        $viagem_list = array( 'Sim', 'Não' );
        if ( in_array( $viagem , $viagem_list ) )
            $this->set_prop( 'viagem', $viagem );

    }

    public function get_morar_fora() {

        return $this->get_prop( 'morar_fora' );

    }

    public function set_morar_fora( $morar_fora ) {
        
        $morar_list = array( 'Sim', 'Não' );
        if ( in_array( $morar_fora , $morar_list ) )
            $this->set_prop( 'morar_fora', $morar_fora );

    }

    protected function set_criado_em( $criado_em ) {

        $this->set_prop( 'criado_em', $criado_em );

    }

    public function get_criado_em() {

        return $this->get_prop( 'criado_em' );

    }

}