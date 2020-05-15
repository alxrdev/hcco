<div class="wrap">
    <h1>Configurações</h1>

    <div class="nav-tab-wrapper">
        <a 
            class="nav-tab 
            <?php echo $active_tab === 'curriculo' ? 'nav-tab-active' : ''; ?>" 
            href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=curriculo' ); ?>"
        >
            <?php _e( 'Currículo', 'hcco' ); ?>
        </a>
        <a 
            class="nav-tab 
            <?php echo $active_tab === 'mercado_pago' ? 'nav-tab-active' : ''; ?>" 
            href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=mercado_pago' ); ?>"
        >
            <?php _e( 'Mercado Pago', 'hcco' ); ?>
        </a>
        <a 
            class="nav-tab 
            <?php echo $active_tab === 'picpay' ? 'nav-tab-active' : ''; ?>" 
            href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=picpay' ); ?>"
        >
            <?php _e( 'PicPay', 'hcco' ); ?>
        </a>
    </div>
    <div class="tabs-content">
        <?php
            if ( method_exists( $this, $method_to_call ) )
                call_user_func( array( $this, $method_to_call ) );
            else
                echo '<h1>' . __( 'Página não encontrada.', 'hfio' ) . '</h1>';
        ?>
    </div>
</div>