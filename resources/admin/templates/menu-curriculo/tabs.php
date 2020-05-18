<div class="wrap">
    <h1>Todos os currículos</h1>

    <div class="nav-tab-wrapper">
        <a 
            class="nav-tab 
            <?php echo $active_tab === 'aprovado' ? 'nav-tab-active' : ''; ?>" 
            href="<?php echo esc_url( '?page=hcco&active_tab=aprovado' ); ?>"
        >
            <?php _e( 'Aprovados', 'hcco' ); ?>
        </a>
        <a 
            class="nav-tab 
            <?php echo $active_tab === 'pendente' ? 'nav-tab-active' : ''; ?>" 
            href="<?php echo esc_url( '?page=hcco&active_tab=pendente' ); ?>"
        >
            <?php _e( 'Pendentes', 'hcco' ); ?>
        </a>
    </div>
    <div class="tabs-content">
        <?php

            require HCCO_PATH . 'resources/admin/templates/menu-curriculo/curriculos.php';

        ?>
    </div>
</div>