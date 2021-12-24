<?php
/**
 * Registrar aqui todas as dependencias
 */

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Registra informações do Twig(Template Engine)
 */
$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/views'
]);

/**
 * Registro de constantes para o twig
 */
$app['url_base'] = URL_BASE;
$app['url_public'] = URL_PUBLIC;
$app['url_auth'] = URL_AUTH;

// Helper para uso de Session
$app['my_session'] =  new Stox\Helpers\Session('TREINAWEB');

/**
 * Registro para funcionar o Iluminate\Database
 */
$capsule = new DB;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => HOST,
    'database' => DB,
    'username' => USER,
    'password' => PASS,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->setAsGlobal();

unset($capsule);

/**
 * Regitra Snappy PDF 
 */
$app['snappy'] = function () {
    $exe = 'C://"Program Files (x86)"/wkhtmltopdf/bin/wkhtmltopdf.exe';
    return new Knp\Snappy\Pdf($exe);
};

/**
 * Regitra Classe Helper de Formulario 
 */
$app['html'] = $app->share(function (){
    return new Stox\Helpers\FormFields;
});

/** 
 * Function Helper
 * Chamada do Twig nos Controllers
 */
function view() {
    global $app;
    return $app['twig'];
}

function session() {
    global $app;
    return $app['my_session'];
}