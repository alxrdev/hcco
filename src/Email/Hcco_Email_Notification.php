<?php

namespace Holos\Hcco\Email;

use Holos\Hcco\Email\Hcco_Email_Templates;

class Hcco_Email_Notification {

    /**
     * Method that sends an email.
     * 
     * @since   1.0.0
     * @access  private
     * @param   string      $to Email addres to send.
     * @param   string      $title The title of the email message.
     * @param   string      $message The html content of the message.
     */
    private function send( string $to, string $title, string $message ) : void {

        // psw 08_E(C%#t@yv
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        wp_mail( $to, $title, $message, $headers );

    }

    /**
     * Method that sends an message when the status is aprovado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_aprovado( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_aprovado_template( $nome );
        $this->send( $email, 'Pagamento Aprovado', $message );

    }

    /**
     * Method that sends an message when the status is rejeitado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_rejeitado( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_rejeitado_template( $nome );
        $this->send( $email, 'Pagamento Rejeitado', $message );

    }

    /**
     * Method that sends an message when the status is pendente.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_pendente( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_pendente_template( $nome );
        $this->send( $email, 'Pagamento Pendente', $message );

    }

    /**
     * Method that sends an message when the status is em mediacao.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_em_mediacao( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_em_mediacao_template( $nome );
        $this->send( $email, 'Pagamento em Mediacao', $message );

    }

    /**
     * Method that sends an message when the status is em processo.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_em_processo( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_em_processo_template( $nome );
        $this->send( $email, 'Pagamento em Processo', $message );

    }

    /**
     * Method that sends an message when the status is autorizado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_autorizado( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_autorizado_template( $nome );
        $this->send( $email, 'Pagamento Autorizado', $message );

    }

    /**
     * Method that sends an message when the status is devolvido.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_devolvido( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_devolvido_template( $nome );
        $this->send( $email, 'Pagamento Devolvido', $message );

    }

    /**
     * Method that sends an message when the status is estornado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_estornado( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_estornado_template( $nome );
        $this->send( $email, 'Pagamento Estornado', $message );

    }

    /**
     * Method that sends an message when the status is cancelado.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $nome The customer's name.
     * @param   string      $email The customer's email.
     */
    public function send_cancelado( string $email, string $nome ) : void {

        $message = Hcco_Email_Templates::get_cancelado_template( $nome );
        $this->send( $email, 'Pagamento Cancelado', $message );

    }

}