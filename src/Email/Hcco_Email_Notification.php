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

}