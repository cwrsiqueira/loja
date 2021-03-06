<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://carlos.pc/loja/");
	$config['dbname'] = 'pronor28_loja';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "https://www.cwrsdevelopment.com/loja/");
	$config['dbname'] = 'pronor28_loja';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'pronor28_carlos';
	$config['dbpass'] = 'cwrs1909';
}

// Acesso Banco de Dados
$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Linguagem e CEP padrões
$config['default_lang'] = 'pt-br';
$config['cep_origin'] = 68911085;

// Cielo SandBox
$config['MerchantId'] = '2117e9da-0e12-4fc7-b376-c7058510a3ff';
$config['MerchantKey'] = 'MIZSNTMPYIJDWZZDGYWTWVOORFFAISYGNVMAKFIL';

// Mercado Pago
$config['mp_appid'] = '3411966379397622';
$config['mp_key'] = 'bNUUDbSyLJLtC6370yVitvAPuFCpUGlR';

// Paypal
$config['paypal_clientid'] = 'AQFOcuDauHEX9uDiFnMemlZDiYyUPqxyM_jxgy4AO8XbMIvcMcDrRfmfHFhKfbG_QZLiJ0dAqNnp0Slz';
$config['paypal_secret'] = 'EFU_Qvn-AYdWRTDHEq051meKEGxLsgq-IL4doeSGrNMZ_HHPVfADTjMn-7I-8GD8YqikgF___yWblajE';

// Gerencianet
$config['gerencianet_clientid'] = 'Client_Id_ffb7e190c3ca28ab244380c80938f8b07e1df018';
$config['gerencianet_clientsecret'] = 'Client_Secret_c0ac443de82f2a069e6a10d29fec15fdc3326acd';
$config['gerencianet_sandbox'] = true;

// Pagseguro
$config['pagseguro_seller'] = 'cwrsiqueira@msn.com';

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("loja")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("loja")->setRelease("1.0.0");

\PagSeguro\Configuration\Configure::setEnvironment('sandbox');
\PagSeguro\Configuration\Configure::setAccountCredentials('cwrsiqueira@msn.com', 'BA4C77D506A043E9B943C0B0FFDAAD00');
\PagSeguro\Configuration\Configure::setCharset('UTF-8');
\PagSeguro\Configuration\Configure::setLog(true, 'pagseguro.log');

?>