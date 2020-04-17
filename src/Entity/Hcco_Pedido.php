<?php

namespace Holos\Hcco\Entity;

use Holos\Hcco\Entity\Hcco_Entity;

class Hcco_Pedido extends Hcco_Entity {

    /*
     * Class properties
     */
    private $id = '';
    private $curriculo_id  = '';
    private $usuario_id  = '';
    private $codigo_referencia = '';
    private $payment_id = '';
    private $preco = '';
    private $status_pagamento = '';
    private $criado_em = '';
    private $atualizado_em = '';

    /**
     * Método que gera o código de referencia do pedido
     * utilizando o nome do cliente e datetime no método md5
     *
     * @param string $nome Nome do cliente
     */
    private function gerar_codigo_referencia() {

        $this->set_codigo_referencia( 'HOLOS_' . md5( current_time( 'd/m/yy h:m:s' ) . rand( 0, 100 ) ) );

    }

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

    public function get_curriculo_id()  {

        return $this->curriculo_id;
    
    }

    public function set_curriculo_id( $curriculo_id ) {

        $this->curriculo_id = $curriculo_id;
    
    }

    public function get_usuario_id() {

        return $this->usuario_id;
    
    }

    public function set_usuario_id( $usuario_id ) {

        $this->usuario_id = $usuario_id;
    
    }

    public function get_codigo_referencia() {

        return $this->codigo_referencia;
    
    }

    protected function set_codigo_referencia( $codigo_referencia ) {

        $this->codigo_referencia = $codigo_referencia;
    
    }

    public function get_payment_id() {

        return $this->payment_id;
    
    }

    public function set_payment_id( $payment_id ) {

        $this->payment_id = $payment_id;
    
    }

    public function get_preco() {

        return $this->preco;
    
    }

    public function set_preco( $preco ) {

        $this->preco = $preco;
    
    }

    public function get_status_pagamento() {

        return $this->status_pagamento;
    
    }

    public function set_status_pagamento( $status_pagamento ) {

        $this->status_pagamento = $status_pagamento;
    
    }

    public function get_criado_em() {

        return $this->criado_em;
    
    }

    public function set_criado_em( $criado_em ) {

        $this->criado_em = $criado_em;
    
    }

    public function get_atualizado_em() {

        return $this->atualizado_em;
    
    }

    public function set_atualizado_em( $atualizado_em ) {

        $this->atualizado_em = $atualizado_em;
    
    }

}