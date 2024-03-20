<?php

use GDO\CLI\CLI;
use GDO\Core\Application;
use GDO\Core\Debug;
use GDO\Core\Logger;
use GDO\Core\ModuleLoader;
use GDO\DB\Database;
use GDO\DogWhatsApp\Module_DogWhatsApp;
use HeadlessChromium\BrowserFactory;

if (PHP_SAPI !== 'cli')
{
    echo "This can only be run from the command line.\n";
    die(-1);
}
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../../../protected/config.php';
require __DIR__ . '/../../../GDO7.php';

CLI::init();
Debug::init();
Logger::init('dog_telegram', Logger::ALL, 'protected/logs_telegram');
Logger::disableBuffer();
Database::init();

final class dog_ehatsapp extends Application
{

    public function isCLI(): bool
    {
        return true;
    }

}

$loader = ModuleLoader::instance();
$loader->loadModulesCache();
$mod = Module_DogWhatsApp::instance();

$browserFactory = new BrowserFactory();
$browser = $browserFactory->createBrowser([
    'headless' => false,
    'debugLogger' => 'php://stdout',
    'connectionDelay' => 1.5,
    'windowSize' => [1920, 1000],
    'enableImages' => true,
    'keepAlive' => true,
]);

$page = $browser->createPage();

$nav = $page->navigate('https://web.whatsapp.com/');

$navigation->waitForNavigation();

