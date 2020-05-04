<?php

namespace Holos\Hcco\Entity;

use Holos\Hcco\Entity\Hcco_Entity;

class Hcco_Curriculo extends Hcco_Entity {

    /*
     * Class properties
     */
    private $id                              = '';
    private $nome                            = '';
    private $data_nascimento                 = '';
    private $sexo                            = '';
    private $nacionalidade                   = '';
    private $estado_civil                    = '';
    private $filhos                          = '';
    private $empregado                       = '';
    private $cnh                             = '';
    private $cep                             = '';
    private $estado                          = '';
    private $cidade                          = '';
    private $bairro                          = '';
    private $endereco                        = '';
    private $numero                          = '';
    private $telefone_1                      = '';
    private $telefone_2                      = '';
    private $email                           = '';
    private $facebook                        = '';
    private $instagram                       = '';
    private $linkedin                        = '';
    private $escolaridade                    = '';
    private $curso_formacao                  = '';
    private $cursos_e_treinamentos           = '';
    private $empresa_1                       = '';
    private $data_entrada_empresa_1          = '';
    private $data_saida_empresa_1            = '';
    private $cargo_empresa_1                 = '';
    private $atividades_exercidas_empresa_1  = '';
    private $empresa_2                       = '';
    private $data_entrada_empresa_2          = '';
    private $data_saida_empresa_2            = '';
    private $cargo_empresa_2                 = '';
    private $atividades_exercidas_empresa_2  = '';
    private $empresa_3                       = '';
    private $data_entrada_empresa_3          = '';
    private $data_saida_empresa_3            = '';
    private $cargo_empresa_3                 = '';
    private $atividades_exercidas_empresa_3  = '';
    private $cargos_profissoes               = '';
    private $ramos_de_atividade              = '';
    private $pretencao_salarial              = '';
    private $viagem                          = '';
    private $morar_fora                      = '';
    private $criado_em                       = '';

    /**
     * Required properties
     */
	protected $required_properties = [ 'nome', 'data_nascimento', 'sexo', 'nacionalidade', 'estado_civil', 'filhos', 'empregado', 'cnh', 'cep', 'estado', 'cidade', 'bairro', 'endereco', 'telefone_1', 'email', 'escolaridade', 'cargos_profissoes', 'ramos_de_atividade', 'pretencao_salarial', 'viagem', 'morar_fora' ];

    /*
    |--------------------------------------------------------------------------
    | GETTERS AND SETTERS methods
    |--------------------------------------------------------------------------
    */

    public function get_id() {

        return $this->id;

    }

    public function set_id( $id ) {

        $this->id = $id;

    }

    public function get_nome() {

        return $this->nome;

    }

    public function set_nome( $nome ) {

        $this->nome = $nome;

    }

    public function get_data_nascimento() {

        return $this->data_nascimento;

    }

    public function set_data_nascimento( $data_nascimento ) {

        $this->data_nascimento = $data_nascimento;

    }

    public function get_sexo() {

        return $this->sexo;

    }

    public function set_sexo( $sexo ) {

        $sexo_list = array( 'Masculino', 'Feminino' );
        if ( in_array( $sexo , $sexo_list ) )
            $this->sexo = $sexo;

    }

    public function get_nacionalidade() {

        return $this->nacionalidade;

    }

    public function set_nacionalidade( $nacionalidade ) {

        $nacionalidade_list = array( 'Afegão', 'Sul-africano', 'Alemão', 'Angolano', 'Saudita', 'Argelino', 'Argentino', 'Armênio', 'Australiano', 'Austríaco', 'Azerbaijano', 'Bangladês', 'Belga', 'Boliviano', 'Brasileiro', 'Búlgaro', 'Cabo-verdense', 'Camaronês', 'Cambojano', 'Canadense', 'Tcheco', 'Chileno', 'Chinês', 'Colombiano', 'Norte-coreano', 'Sul-coreano', 'Costa-marfinense', 'Costa-riquenho', 'Croata', 'Cubano', 'Dinamarquês', 'Dominicano', 'Egípcio', 'Equatoriano', 'Eslovaco', 'Esloveno', 'Espanhol', 'Norte-americano', 'Estoniano', 'Etíope', 'Filipino', 'Finlandês', 'Franês', 'Ganense', 'Georgiano', 'Grego', 'Groenlandês', 'Guatemalteco', 'Guineano', 'Haitiano', 'Hondurenho', 'Húngaro', 'Indiano', 'Indonésio', 'Iraniano', 'Iraquiano', 'Irlandês', 'Islandês', 'Israelense', 'Italiano', 'Jamaicano', 'Japonês', 'Kuwaitiano', 'Letão', 'Libanês', 'Líbio', 'Lituano', 'Macedônio', 'Malaio', 'Marroquino', 'Mexicano', 'Moçambicano', 'Mongol', 'Nepalês', 'Nicaraguense', 'Nigeriano', 'Norueguês', 'Neozelandês', 'Palestino', 'Panamenho', 'Paquistanês', 'Paraguaio', 'Peruano', 'Polinésio', 'Polonês', 'Port-riquenho', 'Português', 'Queniano', 'Britânico', 'Escocês', 'Inglês', 'Romeno', 'Russo', 'Senegalês', 'Serra-leonês', 'Sérvio', 'Cingapuriano', 'Sírio', 'Somali', 'Sueco', 'Suíço', 'Surinamês', 'Tailandês', 'Taiwanês', 'Togolês', 'Tunisiano', 'Turco', 'Ucraniano', 'Ugandense', 'Uruguaio', 'Venezuelano', 'Vietnamita', 'Zambiano', 'Zimbabuano' );
        if ( in_array( $nacionalidade , $nacionalidade_list ) )
            $this->nacionalidade = $nacionalidade;

    }

    public function get_estado_civil() {

        return $this->estado_civil;

    }

    public function set_estado_civil( $estado_civil ) {

        $estado_civil_list = array( 'Solteiro', 'Casado', 'Divorciado', 'Separado', 'Amasiado', 'Viúvo' );
        if ( in_array( $estado_civil , $estado_civil_list ) )
            $this->estado_civil = $estado_civil;

    }

    public function get_filhos() {

        return $this->filhos;

    }

    public function set_filhos( $filhos ) {

        $filhos_list = array( 'Sim', 'Não' );
        if ( in_array( $filhos , $filhos_list ) )
            $this->filhos = $filhos;

    }

    public function get_empregado() {

        return $this->empregado;

    }

    public function set_empregado( $empregado ) {

        $empregado_list = array( 'Sim', 'Não' );
        if ( in_array( $empregado , $empregado_list ) )
            $this->empregado = $empregado;

    }

    public function get_cnh() {

        return $this->cnh;

    }

    public function set_cnh( $cnh ) {

        $cnh_list = array( 'Não', 'a', 'b', 'ab', 'c', 'd', 'e' );
        if ( in_array( $cnh , $cnh_list ) )
            $this->cnh = $cnh;

    }

    public function get_cep() {

        return $this->cep;

    }

    public function set_cep( $cep ) {

        $this->cep = $cep;

    }

    public function get_estado() {

        return $this->estado;

    }

    public function set_estado( $estado ) {

        $this->estado = strtoupper( $estado );

    }

    public function get_cidade() {

        return $this->cidade;

    }

    public function set_cidade( $cidade ) {

        $this->cidade = $cidade;

    }

    public function get_bairro() {

        return $this->bairro;

    }

    public function set_bairro( $bairro ) {

        $this->bairro = $bairro;

    }

    public function get_endereco() {

        return $this->endereco;

    }

    public function set_endereco( $endereco ) {

        $this->endereco = $endereco;

    }

    public function get_numero() {

        return $this->numero;

    }

    public function set_numero( $numero ) {

        $this->numero = $numero;

    }

    public function get_telefone_1() {

        return $this->telefone_1;

    }

    public function set_telefone_1( $telefone_1 ) {

        $this->telefone_1 = $telefone_1;

    }

    public function get_telefone_2() {

        return $this->telefone_2;

    }

    public function set_telefone_2( $telefone_2 ) {

        $this->telefone_2 = $telefone_2;

    }

    public function get_email() {

        return $this->email;

    }

    public function set_email( $email ) {

        $this->email = $email;

    }

    public function get_facebook() {

        return $this->facebook;

    }

    public function set_facebook( $facebook ) {

        $this->facebook = $facebook;

    }

    public function get_instagram() {

        return $this->instagram;

    }

    public function set_instagram( $instagram ) {

        $this->instagram = $instagram;

    }

    public function get_linkedin() {

        return $this->linkedin;

    }

    public function set_linkedin( $linkedin ) {

        $this->linkedin = $linkedin;

    }

    public function get_escolaridade() {

        return $this->escolaridade;

    }

    public function set_escolaridade( $escolaridade ) {

        $escolaridade_list = array( 'Doutorado Completo', 'Doutorado Incompleto', 'Mestrado Completo', 'Mestrado Incompleto', 'Pós-graduação Completa', 'Pós-graduação Incompleta', 'Superior Completo', 'Superior Incompleto', 'Curso Técnico Completo', 'Curso Técnico Incompleto', 'Ensino Médio Completo', 'Ensino Médio Incompleto', 'Ensino Fundamental Completo', 'Ensino Fundamental Incompleto', 'Não Alfabetizado' );
        if ( in_array( $escolaridade, $escolaridade_list ) )
            $this->escolaridade = $escolaridade;

    }

    public function get_curso_formacao() {

        return $this->curso_formacao;

    }

    public function set_curso_formacao( $curso_formacao ) {

        $this->curso_formacao = $curso_formacao;

    }

    public function get_cursos_e_treinamentos() {

        return $this->cursos_e_treinamentos;

    }

    public function set_cursos_e_treinamentos( $cursos_e_treinamentos ) {

        $this->cursos_e_treinamentos = $cursos_e_treinamentos;

    }

    public function get_empresa_1() {

        return $this->empresa_1;

    }

    public function set_empresa_1( $empresa_1 ) {

        $this->empresa_1 = $empresa_1;

    }

    public function get_data_entrada_empresa_1() {

        return $this->data_entrada_empresa_1;

    }

    public function set_data_entrada_empresa_1( $data_entrada_empresa_1 ) {

        $this->data_entrada_empresa_1 = $data_entrada_empresa_1;

    }

    public function get_data_saida_empresa_1() {

        return $this->data_saida_empresa_1;

    }

    public function set_data_saida_empresa_1( $data_saida_empresa_1 ) {

        $this->data_saida_empresa_1 = $data_saida_empresa_1;

    }

    public function get_cargo_empresa_1() {

        return $this->cargo_empresa_1;

    }

    public function set_cargo_empresa_1( $cargo_empresa_1 ) {

        $this->cargo_empresa_1 = $cargo_empresa_1;

    }

    public function get_atividades_exercidas_empresa_1() {

        return $this->atividades_exercidas_empresa_1;

    }

    public function set_atividades_exercidas_empresa_1( $atividades_exercidas_empresa_1 ) {

        $this->atividades_exercidas_empresa_1 = $atividades_exercidas_empresa_1;

    }

    public function get_empresa_2() {

        return $this->empresa_2;

    }

    public function set_empresa_2( $empresa_2 ) {

        $this->empresa_2 = $empresa_2;

    }

    public function get_data_entrada_empresa_2() {

        return $this->data_entrada_empresa_2;

    }

    public function set_data_entrada_empresa_2( $data_entrada_empresa_2 ) {

        $this->data_entrada_empresa_2 = $data_entrada_empresa_2;

    }

    public function get_data_saida_empresa_2() {

        return $this->data_saida_empresa_2;

    }

    public function set_data_saida_empresa_2( $data_saida_empresa_2 ) {

        $this->data_saida_empresa_2 = $data_saida_empresa_2;

    }

    public function get_cargo_empresa_2() {

        return $this->cargo_empresa_2;

    }

    public function set_cargo_empresa_2( $cargo_empresa_2 ) {

        $this->cargo_empresa_2 = $cargo_empresa_2;

    }

    public function get_atividades_exercidas_empresa_2() {

        return $this->atividades_exercidas_empresa_2;

    }

    public function set_atividades_exercidas_empresa_2( $atividades_exercidas_empresa_2 ) {

        $this->atividades_exercidas_empresa_2 = $atividades_exercidas_empresa_2;

    }

    public function get_empresa_3() {

        return $this->empresa_3;

    }

    public function set_empresa_3( $empresa_3 ) {

        $this->empresa_3 = $empresa_3;

    }

    public function get_data_entrada_empresa_3() {

        return $this->data_entrada_empresa_3;

    }

    public function set_data_entrada_empresa_3( $data_entrada_empresa_3 ) {

        $this->data_entrada_empresa_3 = $data_entrada_empresa_3;

    }

    public function get_data_saida_empresa_3() {

        return $this->data_saida_empresa_3;

    }

    public function set_data_saida_empresa_3( $data_saida_empresa_3 ) {

        $this->data_saida_empresa_3 = $data_saida_empresa_3;

    }

    public function get_cargo_empresa_3() {

        return $this->cargo_empresa_3;

    }

    public function set_cargo_empresa_3( $cargo_empresa_3 ) {

        $this->cargo_empresa_3 = $cargo_empresa_3;

    }

    public function get_atividades_exercidas_empresa_3() {

        return $this->atividades_exercidas_empresa_3;

    }

    public function set_atividades_exercidas_empresa_3( $atividades_exercidas_empresa_3 ) {

        $this->atividades_exercidas_empresa_3 = $atividades_exercidas_empresa_3;

    }

    public function get_cargos_profissoes() {

        return $this->cargos_profissoes;

    }

    public function set_cargos_profissoes( $cargos_profissoes ) {

        $this->cargos_profissoes = $cargos_profissoes;

    }

    public function get_ramos_de_atividade() {

        return $this->ramos_de_atividade;

    }

    public function set_ramos_de_atividade( $ramos_de_atividade ) {

        $this->ramos_de_atividade = $ramos_de_atividade;

    }

    public function get_pretencao_salarial() {

        return $this->pretencao_salarial;

    }

    public function set_pretencao_salarial( $pretencao_salarial ) {

        $pretencao_salarial_list = array( 'A combinar', 'Até R$ 1000.00', 'A partir de R$ 1000.00', 'A partir de R$ 2000.00', 'A partir de R$ 3000.00', 'A partir de R$ 4000.00', 'A partir de R$ 5000.00', 'A partir de R$ 6000.00' );
        if ( in_array( $pretencao_salarial , $pretencao_salarial_list ) )
            $this->pretencao_salarial = $pretencao_salarial;

    }

    public function get_viagem() {

        return $this->viagem;

    }

    public function set_viagem( $viagem ) {

        $viagem_list = array( 'Sim', 'Não' );
        if ( in_array( $viagem , $viagem_list ) )
            $this->viagem = $viagem;

    }

    public function get_morar_fora() {

        return $this->morar_fora;

    }

    public function set_morar_fora( $morar_fora ) {
        
        $morar_list = array( 'Sim', 'Não' );
        if ( in_array( $morar_fora , $morar_list ) )
            $this->morar_fora = $morar_fora;

    }

    protected function set_criado_em( $criado_em ) {

        $this->criado_em = $criado_em;

    }

    public function get_criado_em() {

        return $this->criado_em;

    }

}