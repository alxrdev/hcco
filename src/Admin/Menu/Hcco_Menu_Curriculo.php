<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Admin\ListTable\Hcco_Curriculo_List_Table;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_Menu_Curriculo {

    /**
     * Display Home Page
     * 
     * @since   1.0.0
     * @access  public
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

    /**
     * Display a individual curriculo
     * 
     * @since   1.0.0
     * @access  public
     */
    public function view() {

        $curriculo_id = sanitize_text_field( $_GET['curriculo'] );
        $curriculo = Hcco_Curriculo_Mapper::fetch( $curriculo_id );

        ?>
        <div class="wrap">
            <h1>Currículo</h1>

            <div>
                <h2>Dados principais</h2>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Nome</th>
                        <td><?php echo $curriculo->get_nome(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de nascimento</th>
                        <td><?php echo $curriculo->get_data_nascimento(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Sexo</th>
                        <td><?php echo $curriculo->get_sexo(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nacionalidade</th>
                        <td><?php echo $curriculo->get_nacionalidade(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Estado civil</th>
                        <td><?php echo $curriculo->get_estado_civil(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Possui filhos</th>
                        <td><?php echo $curriculo->get_filhos(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Esta empregado</th>
                        <td><?php echo $curriculo->get_empregado(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Possui CNH</th>
                        <td><?php echo $curriculo->get_cnh(); ?></td>
                    </tr>
                </table>
            </div>

            <div>
                <h2>Dados de contato</h2>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">CEP</th>
                        <td><?php echo $curriculo->get_cep(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Estado</th>
                        <td><?php echo $curriculo->get_estado(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cidade</th>
                        <td><?php echo $curriculo->get_cidade(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Bairro</th>
                        <td><?php echo $curriculo->get_bairro(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Endereço</th>
                        <td><?php echo $curriculo->get_endereco(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">N°</th>
                        <td><?php echo $curriculo->get_numero(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone 1</th>
                        <td><?php echo $curriculo->get_telefone_1(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone 2</th>
                        <td><?php echo $curriculo->get_telefone_2(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td><?php echo $curriculo->get_email(); ?></td>
                    </tr>
                </table>
            </div>

            <div>
                <h2>Formação acadêmica</h2>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Escolaridade</th>
                        <td><?php echo $curriculo->get_escolaridade(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Curso de formação</th>
                        <td><?php echo $curriculo->get_curso_formacao(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cursos e treinamentos</th>
                        <td><?php echo $curriculo->get_cursos_e_treinamentos(); ?></td>
                    </tr>
                </table>
            </div>

            <div>
                <h2>Experiências profissionais</h2>
                
                <h4>Ultima empresa</h4>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Nome da empresa</th>
                        <td><?php echo $curriculo->get_empresa_1(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de entrada</th>
                        <td><?php echo $curriculo->get_data_entrada_empresa_1(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de saída</th>
                        <td><?php echo $curriculo->get_data_saida_empresa_1(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cargo</th>
                        <td><?php echo $curriculo->get_cargo_empresa_1(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Atividades exercídas</th>
                        <td><?php echo $curriculo->get_atividades_exercidas_empresa_1(); ?></td>
                    </tr>
                </table>

                <h4>Penultima empresa</h4>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Nome da empresa</th>
                        <td><?php echo $curriculo->get_empresa_2(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de entrada</th>
                        <td><?php echo $curriculo->get_data_entrada_empresa_2(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de saída</th>
                        <td><?php echo $curriculo->get_data_saida_empresa_2(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cargo</th>
                        <td><?php echo $curriculo->get_cargo_empresa_2(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Atividades exercídas</th>
                        <td><?php echo $curriculo->get_atividades_exercidas_empresa_2(); ?></td>
                    </tr>
                </table>

                <h4>Antepenultima empresa</h4>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Nome da empresa</th>
                        <td><?php echo $curriculo->get_empresa_3(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de entrada</th>
                        <td><?php echo $curriculo->get_data_entrada_empresa_3(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Data de saída</th>
                        <td><?php echo $curriculo->get_data_saida_empresa_3(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Cargo</th>
                        <td><?php echo $curriculo->get_cargo_empresa_3(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Atividades exercídas</th>
                        <td><?php echo $curriculo->get_atividades_exercidas_empresa_3(); ?></td>
                    </tr>
                </table>
            </div>

            <div>
                <h2>Objetivos profissionais</h2>
                <table class="wp-list-table widefat fixed striped">
                    <tr>
                        <th scope="row">Cargos/Profissões</th>
                        <td><?php echo $curriculo->get_cargos_profissoes(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Ramos de atividade</th>
                        <td><?php echo $curriculo->get_ramos_de_atividade(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Pretenção salarial</th>
                        <td><?php echo $curriculo->get_pretencao_salarial(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tem disponibilidade para viagem?</th>
                        <td><?php echo $curriculo->get_viagem(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tem disponibilidade para morar fora?</th>
                        <td><?php echo $curriculo->get_morar_fora(); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php

    }

    /**
     * Method that receive an ajax request and delete an curriculo.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function delete_curriculo() {

        // get the parameters
        $nonce = $_POST['_wpnonce'] ?? '';
        $id = sanitize_text_field( $_POST['curriculo_id'] ?? '' );

        // verify the nonce
        if ( ! wp_verify_nonce( $nonce, 'delete_curriculo' . $id ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }
        
        // delete the curriculo
        Hcco_Curriculo_Mapper::delete( $id );
        Hcco_Pedido_Mapper::delete( Hcco_Pedido_Mapper::get_by_curriculo_id( $id )->get_id() );

        wp_send_json_success( 'Curriculo ' . $id . ' deleted' );
        wp_die();

    }

}