<?php

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 * User: ingvar.aasen
 * Date: 18.06.2018
 */
class Module implements ConfigProviderInterface
{
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
