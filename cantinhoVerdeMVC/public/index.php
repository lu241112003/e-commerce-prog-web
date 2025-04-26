<!-- Esse é o ponto de entrada do seu sistema. Ele vai carregar a estrutura MVC e iniciar o roteador. -->

<?php

require_once '../app/config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';

$app = new App();
