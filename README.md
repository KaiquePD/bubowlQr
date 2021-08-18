#Comandos 
composer require laravel/ui:^2.4    <!-- Instala o Guard Auth -->
php artisan ui bootstrap
php artisan ui vue
php artisan ui react

<!--
 Por mais que o npm já esteja instalado é necessario executar novamente 
 por causa dos comandos acima, que mexeram no package.json
 e vai ter que rodar 'npm run dev' para executar o package.json
  -->
npm install
npm run dev
npm run production

<!--
 Caso for editar o SASS/SCSS ou até mesmo editar alguma biblioteca JS 
 como: react, vue e assim outras. Executar o comando abaixo para o terminal
 compila assim que finalizado a edição, diferente do 'npm run dev' que após a edição
 tem que ser executado novamente. Basicamente o comando abaixo serve como o auto save do Visual Code
 -->
 npm run watch



 Gerador de models:
 https://github.com/reliese/laravel

  - composer require reliese/laravel
