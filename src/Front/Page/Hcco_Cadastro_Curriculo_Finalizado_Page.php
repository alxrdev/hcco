<?php

namespace Holos\Hcco\Front\Page;

use Holos\Hcco\Front\Page\Hcco_Front_Page;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_Cadastro_Curriculo_Finalizado_Page extends Hcco_Front_Page {

    /**
     * The home page.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function home() : void {

        // get the ref_code param
        $ref_code = sanitize_text_field( $_GET['ref_code'] ?? '' );

        // checks if the ref_code param is empty
        if ( empty( $ref_code ) ) {
            wp_redirect( home_url( '/cadastro-de-curriculo' ) );
            exit;
        }

        // get the pedido and curriculo
        $pedido = Hcco_Pedido_Mapper::get_by_codigo_referencia( $ref_code );
        $curriculo = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );

        // reset the cookie.
        if ( ! $this->validate_pedido( $pedido ) ) {

            setcookie( 'user_id_hash', '', time() - 3600, '/' );

        }

        $this->display_content( 
            $curriculo->get_nome(),
            $this->get_payment_status( $pedido->get_status_pagamento() ), 
            $this->get_message( $pedido->get_status_pagamento() ) 
        );

    }

    /**
     * Method that return an message based on pedido payment status.
     * 
     * @since   1.0.0
     * @access  private
     * @param   string      $status Pedido payment status.
     * @return  string      Message to display.
     */
    private function get_message( string $status ) : string {

        $messages = array(
            'aprovado'      => '<p>Recebemos o pagamento do seu currículo, agora ele se encontra em nosso banco de dados, fique atento ao seu telefone, pois assim que abrirem vagas com o seu perfil, ligaremos para você.</p>',
            'rejeitado'     => '<p>Infelizmente seu pagamento foi rejeitado, mas não fique triste, clique <a href="https://holoscdh.com.br/finalizar-o-cadastro-do-curriculo" title="Finalizar o cadastro do currículo">aqui</a> e tente realizar o pagamento novamente.</p>',
            'pendente'      => '<p>Estamos aguardando o pagamento do seu currículo, clique <a href="https://holoscdh.com.br/finalizar-o-cadastro-do-curriculo" title="Finalizar o cadastro do currículo">aqui</a> para realizar o pagamento, caso já o tenha realizado, desconsidere esta mensagem.</p>',
            'em_mediacao'   => '<p>Estamos aguardando a confirmação do pagamento do seu currículo, assim que a recebermos, te enviaremos um email de confirmação.</p>',
            'em_processo'   => '<p>Estamos aguardando a confirmação do pagamento do seu currículo, assim que a recebermos, te enviaremos um email de confirmação.</p>',
            'autorizado'    => '<p>O pagamento do seu currículo foi autorizado, porém estamos aguardando a confirmação do pagamento, assim que a recebermos, te enviaremos um email de confirmação.</p>',
            'devolvido'     => '<p>O pagamento do seu currículo já foi devolvido.</p>',
            'estornado'     => '<p>O pagamento do seu currículo já foi estornado.</p>',
            'cancelado'     => '<p>O pagamento do seu currículo já foi cancelado.</p>'
        );

        return $messages[$status] ?? '';

    }

    /**
     * Method that return an cliente ui pedido payment status.
     * 
     * @since   1.0.0
     * @access  private
     * @param   string      $status Pedido payment status.
     * @return  string      The payment status.
     */
    private function get_payment_status( string $status ) : string {

        $payment_status = array(
            'aprovado'      => 'Aprovado',
            'rejeitado'     => 'Rejeitado',
            'pendente'      => 'Pendente',
            'em_mediacao'   => 'Em Mediação',
            'em_processo'   => 'Em processo',
            'autorizado'    => 'Autorizado',
            'devolvido'     => 'Devolvido',
            'estornado'     => 'Estornado',
            'cancelado'     => 'Cancelado'
        );

        return $payment_status[$status] ?? '';

    }

    /**
     * Display the page content.
     * 
     * @since   1.0.0
     * @access  private
     */
    private function display_content( string $nome, string $status, string $message ) : void {

        $this->display_header();

        ?>
        <div class="page-content">
            <div class="section">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h2 class="text-center mb-5" style="font-size: 46px;">Pedido <?php echo $status; ?></h2>
                            <p><span style="font-size: 25px;">Olá <strong><?php echo $nome; ?></strong>,</span></p>
                            <?php echo $message; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

        $this->display_footer();

    }

}