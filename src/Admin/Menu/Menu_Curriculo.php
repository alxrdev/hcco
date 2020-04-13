<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Admin\ListTable\Hcco_Curriculo_List_Table;

class Menu_Curriculo {

    /**
     * Display Home Page
     */
    public function home() {

        $curriculo_list_table = new Hcco_Curriculo_List_Table();
        $curriculo_list_table->prepare_items();

        ?>
        <div class="wrap">
            <h1>Todos os currículos</h1>

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
        <?php

    }
    
}