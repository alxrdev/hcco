<div class="wrap">
    <div class="hcco-list-table">
        <form action="" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <?php

            $curriculo_list_table->search_box( __( 'Buscar', 'hcco' ), 'hcco-buscar-curriculo' );
            $curriculo_list_table->display(); 

            ?>
        </form>
    </div>
</div>