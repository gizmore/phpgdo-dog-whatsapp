<?php
namespace GDO\DogWhatsApp;

use GDO\Core\GDO_DBException;
use GDO\Core\GDO_Module;
use GDO\Dog\DOG_Server;

final class Module_DogWhatsApp extends GDO_Module
{

    /**
     * @throws GDO_DBException
     */
    public function onInstall(): void
    {
        if (!DOG_Server::getBy('serv_connector', 'WhatsApp'))
        {
            DOG_Server::blank([
                'serv_url' => 'https://web.whatsapp.com/',
                'serv_tls' => '1',
                'serv_connector' => 'WhatsApp',
                'serv_username' => 'Dog',
                'serv_connect_timeout' => '15s',
                'serv_throttle' => 5,
                'serv_active' => '1',
            ])->insert();
        }
    }

    public function onLoadLanguage(): void
    {
        $this->loadLanguage('lang/whapp');
    }

    public function getDependencies(): array
    {
        return [
            'Dog',
        ];
    }

}
