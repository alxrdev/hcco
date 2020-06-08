<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;

class Hcco_Mercado_Pago {

    /**
     * Propertie that stores the pagseguro token.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro private token.
     */
    private $token;

    /**
     * Propertie that stores the pagseguro email.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro email.
     */
    private $email;

    /**
     * Contructor method.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function __construct() {

        $credentials = Hcco_Configuracoes_Mapper::get_pagseguro_credentials();
        $this->email = $credentials['email'];
        $this->token = $credentials['token'];

    }

    /**
     * Method that process a credit card payment.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	Hcco_Pedido		$pedido Pedido entity.
     * @param	Hcco_Curriculo	$curriculo Curriculo entity.
     */
    public function process_credit_card_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) : void {

        //

    }

    /**
     * Method that return the payment status in portugues.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string		$status The status name.
     * @return	string		Payment status.
     */
    public static function get_status_pt( string $status ) : string {

        $status_list = array(
            'approved' 		=> 'aprovado',
            'in_mediation' 	=> 'em_mediacao',
            'in_process' 	=> 'em_processo',
            'pending' 		=> 'pendente',
            'authorized' 	=> 'autorizado',
            'refunded' 		=> 'devolvido',
            'charged_back' 	=> 'estornado',
            'cancelled' 	=> 'cancelado',
            'rejected' 		=> 'rejeitado'
        );

        return $status_list[$status] ?? 'pendente';

    }

}