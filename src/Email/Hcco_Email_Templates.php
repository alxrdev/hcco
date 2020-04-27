<?php

namespace Holos\Hcco\Email;

class Hcco_Email_Templates {

    /**
     * Method that return the html content of the email header.
     * 
     * @since   1.0.0
     * @access  private
     * @return  string  The html content.
     */
    private static function get_header() : string {

        $content = file_get_contents( HCCO_PATH . '/resources/email/header.html' );

        return $content;

    }

    /**
     * Method that return the html content of the email footer.
     * 
     * @since   1.0.0
     * @access  private
     * @return  string  The html content.
     */
    private static function get_footer() : string {

        $content = file_get_contents( HCCO_PATH . '/resources/email/footer.html' );

        return $content;

    }

    /**
     * Method that return the html content of content section.
     * 
     * @since   1.0.0
     * @access  private
     * @param   string  $message The content of email.
     * @return  string  The html content.
     */
    private static function get_content( string $message ) : string {

        $content = "
            <!-- Content -->
            <div style=\"background-color:transparent;\">
            <div class=\"block-grid\" style=\"Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;\">
            <div style=\"border-collapse: collapse;display: table;width: 100%;background-color:transparent;\">
            <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:transparent;\"><tr><td align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:700px\"><tr class=\"layout-full-width\" style=\"background-color:transparent\"><![endif]-->
            <!--[if (mso)|(IE)]><td align=\"center\" width=\"700\" style=\"background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:55px;\"><![endif]-->
            <div class=\"col num12\" style=\"min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top; width: 700px;\">
            <div style=\"width:100% !important;\">
            <!--[if (!mso)&(!IE)]><!-->
            <div style=\"border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:30px; padding-bottom:55px; padding-right: 0px; padding-left: 0px;\">
            <!--<![endif]-->
            <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif\"><![endif]-->
            <div style=\"color:#555555;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:1.8;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:30px;\">
            <div style=\"font-size: 14px; line-height: 1.8; color: #555555; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 25px;\">
        ";
        $content .= $message;
        $content .= "
            </div></div>
            <!--[if mso]></td></tr></table><![endif]-->
            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\" width=\"100%\">
            <tbody>
            <tr style=\"vertical-align: top;\" valign=\"top\">
            <td class=\"divider_inner\" style=\"word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;\" valign=\"top\">
            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider_content\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #BBBBBB; width: 100%;\" valign=\"top\" width=\"100%\">
            <tbody>
            <tr style=\"vertical-align: top;\" valign=\"top\">
            <td style=\"word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\"><span></span></td></tr></tbody></table></td></tr></tbody></table>
            <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif\"><![endif]-->
            <div style=\"color:#555555;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:1.8;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:30px;\">
            <div style=\"font-size: 14px; line-height: 1.8; color: #555555; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 25px;\">
            <span style=\"font-size: 17px; mso-ansi-font-size: 18px;\">Caso possua alguma dúvida, por favor entre em contato: </span>
            <ul>
            <li style=\"font-size: 16px; line-height: 1.8; mso-line-height-alt: 29px;\"><span style=\"font-size: 16px;\"><strong>E-mail:</strong> <a href=\"mailto:holossm@gmail.com?subject=Dúvida sobre o cadastro de currículo\" style=\"text-decoration: underline; color: #f8b370;\" title=\"holossm@gmail.com\">holossm@gmail.com</a></span></li>
            <li style=\"font-size: 16px; line-height: 1.8; mso-line-height-alt: 29px;\"><span style=\"font-size: 16px;\"><strong>Telefone/Whatsapp:</strong> (27) 3763-3285 | 9 9642-7275 | 9 9988-8575</span></li>
            </ul>
            <span style=\"font-size: 17px; mso-ansi-font-size: 18px;\">Atenciosamente, <strong>Holos Centro de Desenvolvimento Humano.</strong></span>
            </div></div><!--[if mso]></td></tr></table><![endif]--><!--[if (!mso)&(!IE)]><!--></div><!--<![endif]--></div></div><!--[if (mso)|(IE)]></td></tr></table><![endif]--><!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]--></div></div></div><!-- End Content -->
        ";

        return $content;

    }

    /**
     * Method that return the html content of pedido aprovado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_aprovado_template( string $nome ) : string {
        
        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">Recebemos o pagamento do seu currículo, agora ele se encontra em nosso banco de dados, fique atento ao seu telefone, pois assim que abrirem vagas com o seu perfil, ligaremos para você.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido rejeitado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_rejeitado_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">Infelizmente seu pagamento foi rejeitado, mas não fique triste, clique <a href="https://holoscdh.com.br/finalizar-o-cadastro-do-curriculo" title="Finalizar o cadastro do currículo">aqui</a> e tente realizar o pagamento novamente.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido pendente.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_pendente_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">Estamos aguardando o pagamento do seu currículo, clique <a href="https://holoscdh.com.br/finalizar-o-cadastro-do-curriculo" title="Finalizar o cadastro do currículo">aqui</a> para realizar o pagamento, caso já o tenha realizado, desconsidere este email.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido em_mediacao and em_processo.
     * 
     * @since   1.0.0
     * @access  private
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    private static function get_em_mediacao_and_em_processo_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">Estamos aguardando a confirmação do pagamento do seu currículo, assim que a recebermos, te enviaremos um email de confirmação.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido em_mediacao.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_em_mediacao_template( string $nome ) : string {

        $content = self::get_header();

        $message = self::get_em_mediacao_and_em_processo_template( $nome );

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido em_processo.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_em_processo_template( string $nome ) : string {

        $content = self::get_header();

        $message = self::get_em_mediacao_and_em_processo_template( $nome );

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido autorizado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_autorizado_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">O pagamento do seu currículo foi autorizado, porém estamos aguardando a confirmação do pagamento, assim que a recebermos, te enviaremos um email de confirmação.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido devolvido.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_devolvido_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">O pagamento do seu currículo já foi devolvido.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido estornado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_estornado_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">O pagamento do seu currículo já foi estornado.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

    /**
     * Method that return the html content of pedido cancelado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $nome The customer name.
     * @return  string  The html content.
     */
    public static function get_cancelado_template( string $nome ) : string {

        $content = self::get_header();

        $message = '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 25px;">Olá <strong>' . $nome . '</strong>, </span>';
        $message .= '</p>';
        $message .= '<p style="text-align: left; line-height: 1.8; word-break: break-word; font-size: 18px; mso-line-height-alt: 32px; margin: 0;">';
        $message .= '<span style="font-size: 18px;">O pagamento do seu currículo já foi cancelado.</span>';
        $message .= '</p>';

        $content .= self::get_content( $message );
        $content .= self::get_footer();

        return $content;

    }

}