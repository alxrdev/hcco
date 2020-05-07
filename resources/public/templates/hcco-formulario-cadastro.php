<div class="page-content">
    <div class="section">
        <div class="container">
            <?php echo get_the_content(); ?>
        </div>
    </div>

    <div class="pb-5 mb-5">
        <div class="container">
            <div class="hcco-form-container">
                <h3 class="text-center mb-5">Preencha o formulário abaixo para cadastrar o seu curriculo</h3>

                <?php
                // se houver algum erro
                if ( $error == true ) :
                    ?>
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Ops! Ocorreu um erro.</h5>
                        <p style="font-size:0.75rem;">
                            <?php
                            foreach ( $curriculo->get_no_filled_properties_list() as $propertie ) :
                                ?>
                                Por favor, preencha o campo <b><?php echo $propertie; ?></b><br>
                                <?php
                            endforeach;
                            ?>
                        </p>
                    </div>
                    <?php
                endif;
                ?>

                <form action="<?php echo get_the_permalink(); ?>" method="POST" class="wizard-vertical">
                    <?php wp_nonce_field( 'cadastrar_curriculo', 'cadastrar_curriculo_nonce' ); ?>

                    <!-- Dados Principais -->
                    <h3>Dados Principais</h3>
                    <fieldset>
                        <p class="mb-3">Atenção, campos marcados com <span>*</span>, são obrigatórios.</p>
                        <div class="form-group">
                            <label for="nome">Nome completo <span>*</span></label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $curriculo->get_nome(); ?>" required>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_nascimento">Data de nascimento <span>*</span></label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $curriculo->get_data_nascimento(); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sexo" class="d-block">Sexo <span>*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="Masculino" <?php echo ( $curriculo->get_sexo() == 'Masculino' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="sexoMasculino">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexoFeminino" value="Feminino" <?php echo ( $curriculo->get_sexo() == 'Feminino' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="sexoFeminino">Feminino</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nacionalidade">Nacionalidade <span>*</span></label>
                                    <select class="form-control" id="nacionalidade" name="nacionalidade" required>
                                        <option>Afegão</option><option>Sul-africano</option><option>Alemão</option><option>Angolano</option><option>Saudita</option><option>Argelino</option><option>Argentino</option><option>Armênio</option><option>Australiano</option><option>Austríaco</option><option>Azerbaijano</option><option>Bangladês</option><option>Belga</option><option>Boliviano</option><option selected="selected">Brasileiro</option><option>Búlgaro</option><option>Cabo-verdense</option><option>Camaronês</option><option>Cambojano</option><option>Canadense</option><option>Tcheco</option><option>Chileno</option><option>Chinês</option><option>Colombiano</option><option>Norte-coreano</option><option>Sul-coreano</option><option>Costa-marfinense</option><option>Costa-riquenho</option><option>Croata</option><option>Cubano</option><option>Dinamarquês</option><option>Dominicano</option><option>Egípcio</option><option>Equatoriano</option><option>Eslovaco</option><option>Esloveno</option><option>Espanhol</option><option>Norte-americano</option><option>Estoniano</option><option>Etíope</option><option>Filipino</option><option>Finlandês</option><option>Franês</option><option>Ganense</option><option>Georgiano</option><option>Grego</option><option>Groenlandês</option><option>Guatemalteco</option><option>Guineano</option><option>Haitiano</option><option>Hondurenho</option><option>Húngaro</option><option>Indiano</option><option>Indonésio</option><option>Iraniano</option><option>Iraquiano</option><option>Irlandês</option><option>Islandês</option><option>Israelense</option><option>Italiano</option><option>Jamaicano</option><option>Japonês</option><option>Kuwaitiano</option><option>Letão</option><option>Libanês</option><option>Líbio</option><option>Lituano</option><option>Macedônio</option><option>Malaio</option><option>Marroquino</option><option>Mexicano</option><option>Moçambicano</option><option>Mongol</option><option>Nepalês</option><option>Nicaraguense</option><option>Nigeriano</option><option>Norueguês</option><option>Neozelandês</option><option>Palestino</option><option>Panamenho</option><option>Paquistanês</option><option>Paraguaio</option><option>Peruano</option><option>Polinésio</option><option>Polonês</option><option>Port-riquenho</option><option>Português</option><option>Queniano</option><option>Britânico</option><option>Escocês</option><option>Inglês</option><option>Romeno</option><option>Russo</option><option>Senegalês</option><option>Serra-leonês</option><option>Sérvio</option><option>Cingapuriano</option><option>Sírio</option><option>Somali</option><option>Sueco</option><option>Suíço</option><option>Surinamês</option><option>Tailandês</option><option>Taiwanês</option><option>Togolês</option><option>Tunisiano</option><option>Turco</option><option>Ucraniano</option><option>Ugandense</option><option>Uruguaio</option><option>Venezuelano</option><option>Vietnamita</option><option>Zambiano</option><option>Zimbabuano</option><option>Outro</option>
                                        <?php 
                                            if ( ! empty( $curriculo->get_nacionalidade() ) ) :
                                                ?>
                                                <option value="<?php echo $curriculo->get_nacionalidade(); ?>" selected><?php echo $curriculo->get_nacionalidade(); ?></option>
                                                <?php
                                            endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado_civil">Estado Civil <span>*</span></label>
                                    <select class="form-control" id="estado_civil" name="estado_civil" required>
                                        <option value="Solteiro" selected>Solteiro</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Separado">Separado</option>
                                        <option value="Amasiado">Amasiado</option>
                                        <option value="Viúvo">Viúvo</option>
                                        <?php 
                                            if ( ! empty( $curriculo->get_estado_civil() ) ) :
                                                ?>
                                                <option value="<?php echo $curriculo->get_estado_civil(); ?>" selected><?php echo $curriculo->get_estado_civil(); ?></option>
                                                <?php
                                            endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="filhos" class="d-block">Possui Filhos? <span>*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="filhos" id="possuiFilhos" value="Sim" <?php echo ( $curriculo->get_filhos() == 'Sim' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="possuiFilhos">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="filhos" id="naoPossuiFilhos" value="Não" <?php echo ( $curriculo->get_filhos() == 'Não' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="naoPossuiFilhos">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empregado" class="d-block">Esta empregado? <span>*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="empregado" id="empregado" value="Sim" <?php echo ( $curriculo->get_empregado() == 'Sim' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="empregado">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="empregado" id="naoEmpregado" value="Não" <?php echo ( $curriculo->get_empregado() == 'Não' ) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="naoEmpregado">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cnh" class="d-block">Possui CNH? <span>*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="naoPossuiCnh" value="Não" <?php echo ( $curriculo->get_cnh() == 'Não' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="naoPossuiCnh">Não</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhA" value="a" <?php echo ( $curriculo->get_cnh() == 'a' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhA">A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhB" value="b" <?php echo ( $curriculo->get_cnh() == 'b' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhB">B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhAB" value="ab" <?php echo ( $curriculo->get_cnh() == 'ab' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhAB">AB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhC" value="c" <?php echo ( $curriculo->get_cnh() == 'c' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhC">C</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhD" value="d" <?php echo ( $curriculo->get_cnh() == 'd' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhD">D</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cnh" id="possuiCnhE" value="e" <?php echo ( $curriculo->get_cnh() == 'e' ) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="possuiCnhE">E</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <!-- Dados de Contato -->
                    <h3>Dados de Contato</h3>
                    <fieldset>
                        <p class="mb-3">Atenção, campos marcados com <span>*</span>, são obrigatórios.</p>
                        <div class="form-group">
                            <label for="cep">CEP <span>*</span></label>
                            <input type="text" class="form-control" id="cep" name="cep" required value="<?php echo $curriculo->get_cep(); ?>" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Estado <span>*</span></label>
                                    <input type="text" class="form-control" id="estado" name="estado" placeholder="ES" required value="<?php echo $curriculo->get_estado(); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cidade">Cidade <span>*</span></label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required value="<?php echo $curriculo->get_cidade(); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro <span>*</span></label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required value="<?php echo $curriculo->get_bairro(); ?>" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="endereco">Endereço <span>*</span></label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" required value="<?php echo $curriculo->get_endereco(); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numero">N°</label>
                                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $curriculo->get_numero(); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone_1">Telefone 1 <span>*</span></label>
                                    <input type="text" class="form-control" id="telefone_1" name="telefone_1" required value="<?php echo $curriculo->get_telefone_1(); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone_2">Telefone 2</label>
                                    <input type="text" class="form-control" id="telefone_2" name="telefone_2" value="<?php echo $curriculo->get_telefone_2(); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span>*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $curriculo->get_email(); ?>" />
                            <small id="emailHelp" class="form-text text-muted">Insira um email válido, pois usaremos para fazer contato.</small>
                        </div>
                        <div class="form-group">
                            <label for="">Redes Sociais</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?php echo $curriculo->get_facebook(); ?>" />
                            <input type="text" class="form-control mt-3" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo $curriculo->get_instagram(); ?>" />
                            <input type="text" class="form-control mt-3" id="linkedin" name="linkedin" placeholder="Linkedin" value="<?php echo $curriculo->get_linkedin(); ?>" />
                        </div>
                    </fieldset>
                    <!-- Dados de Contato -->

                    <!-- Formação Acadêmica -->
                    <h3>Formação Acadêmica</h3>
                    <fieldset>
                        <p class="mb-3">Atenção, campos marcados com <span>*</span>, são obrigatórios.</p>
                        <div class="form-group">
                            <label for="escolaridade">Escolaridade <span>*</span></label>
                            <select class="form-control" id="escolaridade" name="escolaridade" required>
                                <option value="Doutorado Completo">Doutorado Completo</option>
                                <option value="Doutorado Incompleto">Doutorado Incompleto</option>
                                <option value="Mestrado Completo">Mestrado Completo</option>
                                <option value="Mestrado Incompleto">Mestrado Incompleto</option>
                                <option value="Pós-graduação Completa">Pós-graduação Completa</option>
                                <option value="Pós-graduação Incompleta">Pós-graduação Incompleta</option>
                                <option value="Superior Completo">Superior Completo</option>
                                <option value="Superior Incompleto">Superior Incompleto</option>
                                <option value="Curso Técnico Completo">Curso Técnico Completo</option>
                                <option value="Curso Técnico Incompleto">Curso Técnico Incompleto</option>
                                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                                <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                                <option value="Não Alfabetizado">Não Alfabetizado</option>
                                <?php 
                                    if ( ! empty( $curriculo->get_escolaridade() ) ) :
                                        ?>
                                        <option value="<?php echo $curriculo->get_escolaridade(); ?>" selected><?php echo $curriculo->get_escolaridade(); ?></option>
                                        <?php
                                    endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="curso_formacao">Curso de formação</label>
                            <input type="text" name="curso_formacao" id="curso_formacao" class="form-control" value="<?php echo $curriculo->get_curso_formacao(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cursos_e_treinamentos">Cursos e Treinamentos</label>
                            <textarea name="cursos_e_treinamentos" id="cursos_e_treinamentos" cols="5" rows="3" class="form-control" placeholder="Separe os cursos com ','."><?php echo $curriculo->get_cursos_e_treinamentos(); ?></textarea>
                        </div>
                    </fieldset>
                    <!-- Formação Acadêmica -->

                    <!-- Experiências Profissionais -->
                    <h3>Experiências Profissionais</h3>
                    <fieldset>
                        <p class="mb-3">Atenção, campos marcados com <span>*</span>, são obrigatórios.</p>
                        <div class="mb-5">
                            <h5 class="text-center">Ultima empresa</h5>
                            <div class="form-group">
                                <label for="empresa_1">Nome da empresa</label>
                                <input type="text" class="form-control" id="empresa_1" name="empresa_1" value="<?php echo $curriculo->get_empresa_1(); ?>" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_entrada_empresa_1">Data de entrada</label>
                                        <input type="date" class="form-control" id="data_entrada_empresa_1" name="data_entrada_empresa_1" value="<?php echo $curriculo->get_data_entrada_empresa_1(); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_saida_empresa_1">Data de saida</label>
                                        <input type="date" class="form-control" id="data_saida_empresa_1" name="data_saida_empresa_1" value="<?php echo $curriculo->get_data_saida_empresa_1(); ?>" />
                                        <small id="data_saida_empresa_1_help" class="form-text text-muted">Caso seja seu emprego atual, favor deixar em branco.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargo_empresa_1">Cargo</label>
                                <input type="text" class="form-control" id="cargo_empresa_1" name="cargo_empresa_1" value="<?php echo $curriculo->get_cargo_empresa_1(); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="atividades_exercidas_empresa_1">Atividades exercidas</label>
                                <textarea name="atividades_exercidas_empresa_1" id="atividades_exercidas_empresa_1" cols="5" rows="3" class="form-control" placeholder="Separe as atividades com ','."><?php echo $curriculo->get_atividades_exercidas_empresa_1(); ?></textarea>
                            </div>
                        </div>
                        <div class="mb-5">
                            <h5 class="text-center">Penultima Empresa</h5>
                            <div class="form-group">
                                <label for="empresa_2">Nome da empresa</label>
                                <input type="text" class="form-control" id="empresa_2" name="empresa_2" value="<?php echo $curriculo->get_empresa_2(); ?>" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_entrada_empresa_2">Data de entrada</label>
                                        <input type="date" class="form-control" id="data_entrada_empresa_2" name="data_entrada_empresa_2" value="<?php echo $curriculo->get_data_entrada_empresa_2(); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_saida_empresa_2">Data de saida</label>
                                        <input type="date" class="form-control" id="data_saida_empresa_2" name="data_saida_empresa_2" value="<?php echo $curriculo->get_data_saida_empresa_2(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargo_empresa_2">Cargo</label>
                                <input type="text" class="form-control" id="cargo_empresa_2" name="cargo_empresa_2" value="<?php echo $curriculo->get_cargo_empresa_2(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="atividades_exercidas_empresa_2">Atividades exercidas</label>
                                <textarea name="atividades_exercidas_empresa_2" id="atividades_exercidas_empresa_2" cols="5" rows="3" class="form-control" placeholder="Separe as atividades com ','."><?php echo $curriculo->get_atividades_exercidas_empresa_2(); ?></textarea>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="text-center">Antepenultima Empresa</h5>
                            <div class="form-group">
                                <label for="empresa_3">Nome da empresa</label>
                                <input type="text" class="form-control" id="empresa_3" name="empresa_3" value="<?php echo $curriculo->get_empresa_3(); ?>" />
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_entrada_empresa_3">Data de entrada</label>
                                        <input type="date" class="form-control" id="data_entrada_empresa_3" name="data_entrada_empresa_3" value="<?php echo $curriculo->get_data_entrada_empresa_3(); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_saida_empresa_3">Data de saida</label>
                                        <input type="date" class="form-control" id="data_saida_empresa_3" name="data_saida_empresa_3" value="<?php echo $curriculo->get_data_saida_empresa_3(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargo_empresa_3">Cargo</label>
                                <input type="text" class="form-control" id="cargo_empresa_3" name="cargo_empresa_3" value="<?php echo $curriculo->get_cargo_empresa_3(); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="atividades_exercidas_empresa_3">Atividades exercidas</label>
                                <textarea name="atividades_exercidas_empresa_3" id="atividades_exercidas_empresa_3" cols="5" rows="3" class="form-control" placeholder="Separe as atividades com ','."><?php echo $curriculo->get_atividades_exercidas_empresa_3(); ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Experiências Profissionais -->

                    <!-- Objetivos Profissionais -->
                    <h3>Objetivos Profissionais</h3>
                    <fieldset>
                        <p class="mb-3">Atenção, campos marcados com <span>*</span>, são obrigatórios.</p>
                        <div class="form-group">
                            <label for="cargos_profissoes">Cargos/Profissões pretendidas <span>*</span></label>
                            <textarea name="cargos_profissoes" id="cargos_profissoes" cols="5" rows="3" class="form-control" placeholder="separe os cargos ou prifissões com uma ','." required><?php echo $curriculo->get_cargos_profissoes(); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ramos_de_atividade">Ramos de atividade pretendidas <span>*</span></label>
                            <textarea name="ramos_de_atividade" id="ramos_de_atividade" cols="5" rows="3" class="form-control" placeholder="separe os ramos de atividade com uma ','." required><?php echo $curriculo->get_ramos_de_atividade(); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pretencao_salarial">Pretenção Salarial <span>*</span></label>
                            <select class="form-control" name="pretencao_salarial" id="pretencao_salarial">
                                <option value="A combinar" selected>A combinar</option>
                                <option value="Até R$ 1000.00">Até R$ 1000.00</option>
                                <option value="A partir de R$ 1000.00">A partir de R$ 1000.00</option>
                                <option value="A partir de R$ 2000.00">A partir de R$ 2000.00</option>
                                <option value="A partir de R$ 3000.00">A partir de R$ 3000.00</option>
                                <option value="A partir de R$ 4000.00">A partir de R$ 4000.00</option>
                                <option value="A partir de R$ 5000.00">A partir de R$ 5000.00</option>
                                <option value="A partir de R$ 6000.00">A partir de R$ 6000.00</option>
                                <?php 
                                    if ( ! empty( $curriculo->get_pretencao_salarial() ) ) :
                                        ?>
                                        <option value="<?php echo $curriculo->get_pretencao_salarial(); ?>" selected><?php echo $curriculo->get_pretencao_salarial(); ?></option>
                                        <?php
                                    endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="d-block">Tem disponibilidade para viagens? <span>*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="viagem" id="temDisponibilidadeViagem" value="Sim" <?php echo ( $curriculo->get_viagem() == 'Sim' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="temDisponibilidadeViagem">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="viagem" id="naoTemDisponibilidadeViagem" value="Não" <?php echo ( $curriculo->get_viagem() == 'Não' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="naoTemDisponibilidadeViagem">Não</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="d-block">Tem disponibilidade para morar fora? <span>*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="morar_fora" id="temDisponibilidadeMorarFora" value="Sim" <?php echo ( $curriculo->get_morar_fora() == 'Sim' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="temDisponibilidadeMorarFora">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="morar_fora" id="naoTemDisponibilidadeMorarFora" value="Não" <?php echo ( $curriculo->get_morar_fora() == 'Não' ) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="naoTemDisponibilidadeMorarFora">Não</label>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Objetivos Profissionais -->
                </form>

            </div>
        </div>
    </div>
</div>