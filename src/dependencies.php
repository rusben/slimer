<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../templates', [
      //  'cache' => '../cache'
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};


// Service factory for the PDO 
$container['db'] = function ($c) {
    $db= $c->get('settings')['db'];
    $dbdriver = $db['driver'];
    $dbhost= $db['host'];
    $dbusername= $db['username'];
    $dbpassword= $db['password'];
    $dbdatabase= $db['database'];
    $dbcharset= $db['charset'];
 
    $dbh = new PDO("$dbdriver:host=$dbhost;dbname=$dbdatabase", 
                    $dbusername,
                    $dbpassword,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $dbcharset"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;

};

// Own injected classes
$container['PreStudentService'] = function ($c) {
    return new \App\Service\PreStudentService($c['db']);
};
