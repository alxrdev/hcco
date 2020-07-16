<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_PagSeguro {

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
     * Propertie that stores the pagseguro api address.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro api address.
     */
    private $api_address;

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
        $this->api_address = ( $credentials['ambiente'] == 'production' ) ? 'https://ws.pagseguro.uol.com.br' : 'https://ws.sandbox.pagseguro.uol.com.br';

    }

    /**
     * Method that generate the pagseguro checkout code.
     * 
     * @since   1.0.0
     * @access  public
     * @param   array       $params     PagSeguro required order parameters.
     * @return  string      The PagSeguro checkout code.
     */
    public function get_checkout_code( array $params ) : string {

        $header = array( 'Content-Type application/x-www-form-urlencoded; charset=ISO-8859-1' );
        $url = $this->api_address . '/v2/checkout/?email=' . $this->email . '&token=' . $this->token;

        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_POST, true );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $params ) );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $xml = curl_exec( $curl );

        curl_close($curl);
        
        if( $xml == 'Unauthorized' ) {
            return $xml;
        }

        $result = simplexml_load_string( $xml );

        return $result->code;

    }

    /**
     * Method that return the transaction details.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string	 $transaction_code Transaction code.
     */
    public function get_transaction_details( string $transaction_code ) {

        $url = $this->api_address . '/v3/transactions/' . $transaction_code . '/?email=' . $this->email . '&token=' . $this->token;

        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $xml = curl_exec( $curl );

        curl_close($curl);

        if( $xml == 'Unauthorized' ) {
            return $xml;
        }

        return simplexml_load_string( $xml );

    }

    /**
     * Method that return the transaction details using a notification code.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string	 $transaction_code Transaction code.
     */
    public function get_transaction_details_by_notification_code( string $notification_code ) {

        $url = $this->api_address . '/v3/transactions/notifications/' . $notification_code . '/?email=' . $this->email . '&token=' . $this->token;

        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $xml = curl_exec( $curl );

        curl_close($curl);

        if( $xml == 'Unauthorized' ) {
            return $xml;
        }

        return simplexml_load_string( $xml );

    }

    /**
     * Method that return the payment status in portugues.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string		$status The status name.
     * @return	string		Payment status.
     */
    public static function get_payment_status_pt( string $status ) : string {

        $status_list = array(
            '1'         => 'pendente',
            '2' 	    => 'em_processo',
            '3' 		=> 'aprovado',
            '4' 		=> 'aprovado',
            '7' 	    => 'cancelado'
        );

        return $status_list[$status] ?? 'pendente';

    }

}
