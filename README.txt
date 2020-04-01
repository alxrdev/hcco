


Página de cadastro
    - formulario
    - salva os dados na sessão

Página de checkout
    - Resumo do curriculo
    - Métodos de pagamento

Página de confirmação
    - Menssagem de confirmação

    

Tabelas
    - Curriculo : 
        - id
        - todos os dados

    - Pedido :
        - id
        - curriculo_id - Chave estrangeira
        - usuario_id - Id da sessão do usuário, para poder identificar o curriculo
        - codigo_referencia - Código de referencia para o getway de pagamento
        - status - Status do pagamento ( aprovado, rejeitado, cancelado )