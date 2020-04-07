<?php

namespace Holos\Hcco;

use Holos\Hcco\Admin\Hcco_Curriculo_List_Table;

class Hcco_Admin {

    //
    private $plugin_name;
    
    // 
    private $version;

    /**
     * 
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Method that register all menu items
     */
    public function register_menus() {

		add_menu_page(
			__( 'Curriculos', 'hcco' ), 
			__( 'Curriculos', 'hcco' ), 
			'manage_options', 
			'hcco', 
			array( $this, 'page_curriculos' ),
			'dashicons-schedule', 
			3
		);

    }
    
    /**
     * 
     */
    public function page_curriculos() {

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