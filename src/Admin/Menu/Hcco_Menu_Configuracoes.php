<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Menu_Configuracoes {

    /**
     * Display Home Page
     */
    public function home() {

        ?>
        <div class="wrap">
            <h1>Configuracoes</h1>

            <form action="" method="GET">
                <h3>Curriculo</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Preço do currículo</th>
                        <td>
                            <input type="text" name="hcco_preco" id="hcco_preco" class="regular-text" placeholder="0.00">
                            <p class="description">Use '.' ao invés de ','</p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php

    }

}