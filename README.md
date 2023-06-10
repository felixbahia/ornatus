

## Instalação do projeto

Primeiro faça o git clone do projeto. 
<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    git clone https://github.com/felixbahia/ornatus.git
    
<!--endsec-->
Execute o composer

<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    composer update
    
<!--endsec-->
Encontre o arquvo vendor\symfony\polyfill-php72\Php72.php e faça a seguinte alteração na linha 86. 

<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    return $map[\PHP_OS] ?? 'Unknown';
    
<!--endsec-->
Altere para:

<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    return $map[\PHP_OS] ? $map[\PHP_OS] : 'Unknown';
    
<!--endsec-->
Neste mesmo arquivo faça a seguinte alteração na linha 185.

<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    'UTF-8' !== $encoding = $encoding ?? mb_internal_encoding()
    
<!--endsec-->
Alter para:

<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    'UTF-8' !== $encoding = $encoding ? : mb_internal_encoding()
    
<!--endsec-->

## Alimentar a base

Ajuste o arquivo .env para conexão de seu banco e rode estes comandos nos seu projeto
<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    php artisan key:generate
    php artisan migrate
    php artisan inserir:dados
    
<!--endsec-->


## Comprar

Pare realizar uma compra é necessário, primeiramente, logar com o seguinte usuário
<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    Login: danilofelixbahia@hotmail.com
    Senha: Ornatus@2023
    
<!--endsec-->

  

## Atualizar pedido

Para atualizar o status do pedido rode os comandos nos seu projeto
<!--sec data-title="Your first command: OS X and Linux" data-id="OSX_Linux_whoami" data-collapse=true ces-->

    php artisan verificar:pagamento
    php artisan verificar:entrega
    
<!--endsec-->


## Licença

O software de código aberto licenciado pelo o autor Danilo Bahia
