<?php

namespace Holos\Hcco\Entity;

use Holos\Hcco\Entity\Hcco_Entity;

class Hcco_Pedido extends Hcco_Entity {

    /**
     * Propertie that stores the pedido id.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $id = '';

    /**
     * Propertie that stores the curriculo id.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $curriculo_id  = '';

    /**
     * Propertie that stores the usuario id.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $usuario_id  = '';

    /**
     * Propertie that stores the pedido's codigo de referencia.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $codigo_referencia = '';

    /**
     * Propertie that stores the pedido's payment id.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $payment_id = '';

    /**
     * Propertie that stores the preco.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $preco = '';

    /**
     * Propertie that stores the status do pagamento.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $status_pagamento = '';

    /**
     * Propertie that stores the pedido's created date.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $criado_em = '';


    /**
     * Propertie that stores the pedido's updated date.
     * 
     * @since   1.0.0
     * @access  private
     * @var     string 
     */
    private $atualizado_em = '';

    /**
     * Method that create a reference code from pedido.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function gerar_codigo_referencia() : void {

        $this->set_codigo_referencia( 'HOLOS_' . md5( current_time( 'd/m/yy h:m:s' ) . rand( 0, 100 ) ) );

    }

    /*
    |--------------------------------------------------------------------------
    | GETTERS AND SETTERS methods
    |--------------------------------------------------------------------------
    */

    /**
     * Method that returns the pedido id.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The pedido id.
     */
    public function get_id() : string {

        return $this->id;
    
    }

    /**
     * Method that set the pedido id.
     * 
     * @since   1.0.0
     * @access  public
     * @param   int|string      $id The pedido id.
     */
    public function set_id( $id ) : void {

        $this->id = $id;
    
    }

    /**
     * Method that returns the curriculo id.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The curriculo id.
     */
    public function get_curriculo_id() : string  {

        return $this->curriculo_id;
    
    }

    /**
     * Method that set the curriculo id.
     * 
     * @since   1.0.0
     * @access  public
     * @param   int|string      $curriculo_id The curriculo id.
     */
    public function set_curriculo_id( $curriculo_id ) : void {

        $this->curriculo_id = $curriculo_id;
    
    }

    /**
     * Method that returns the usuario id.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string         The usuario id.
     */
    public function get_usuario_id() : string {

        return $this->usuario_id;
    
    }

    /**
     * Method that set the usuario id.
     * 
     * @since   1.0.0
     * @access  public
     * @param   int|string      $usuario_id The usuario id.
     */
    public function set_usuario_id( $usuario_id ) : void {

        $this->usuario_id = $usuario_id;
    
    }

    /**
     * Method that returns the codigo de referencia.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The codigo de referencia.
     */
    public function get_codigo_referencia() : string {

        return $this->codigo_referencia;
    
    }

    /**
     * Method that set the codigo de referencia.
     * 
     * @since   1.0.0
     * @access  protected
     * @param   string      $codigo_referencia The codigo de referencia.
     */
    protected function set_codigo_referencia( string $codigo_referencia ) : void {

        $this->codigo_referencia = $codigo_referencia;
    
    }

    /**
     * Method that returns the payment id.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string        The payment id.
     */
    public function get_payment_id() : string {

        return $this->payment_id;
    
    }

    /**
     * Method that set the payment id.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $payment_id The payment id.
     */
    public function set_payment_id( string $payment_id ) : void {

        $this->payment_id = $payment_id;
    
    }

    /**
     * Method that returns the preco.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The preco.
     */
    public function get_preco() {

        return $this->preco;
    
    }

    /**
     * Method that set the preco.
     * 
     * @since   1.0.0
     * @access  public
     * @param   int|string|float      $preco The preco.
     */
    public function set_preco( $preco ) : void {

        $this->preco = $preco;
    
    }

    /**
     * Method that returns the payment status.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The payment status.
     */
    public function get_status_pagamento() : string {

        return $this->status_pagamento;
    
    }

    /**
     * Method that set the status de pagamento.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $status_pagamento The status de pagamento.
     */
    public function set_status_pagamento( string $status_pagamento ) : void {

        $this->status_pagamento = $status_pagamento;
    
    }

    /**
     * Method that returns the pedido's created at date.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string    The created at date.
     */
    public function get_criado_em() : string {

        return $this->criado_em;
    
    }

    /**
     * Method that set the pedido's created at.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $criado_em The pedido's created at.
     */
    public function set_criado_em( $criado_em ) : void {

        $this->criado_em = $criado_em;
    
    }

    /**
     * Method that returns the pedido's updated at date.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The pedido's updated at date.
     */
    public function get_atualizado_em() : string {

        return $this->atualizado_em;
    
    }

    /**
     * Method that set the pedido's updated at.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string      $criado_em The pedido's updated at.
     */
    public function set_atualizado_em( $atualizado_em ) : void {

        $this->atualizado_em = $atualizado_em;
    
    }

}