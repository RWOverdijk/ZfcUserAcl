<?php

namespace ZfcUserAcl;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider,
    Zend\Module\Consumer\LocatorRegistered;

class Module implements AutoloaderProvider, LocatorRegistered
{
    protected $options;

    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();

        $moduleManager->events()->attach('loadModules.post', array($this, 'modulesLoaded'));
        $events->attach('bootstrap', 'bootstrap', function($e) use ($events) {
            $di       = $e->getParam('application')->getLocator();
            $listener = $di->get('zfcuseracl_mvc_listener');
            $events->attach('Zend\Mvc\Application', 'dispatch', $listener, 5000);
        }, 100);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        $this->options = $config['zfcuseracl'];
    }

    /**
     * @TODO: Come up with a better way of handling module settings/options
     */
    public function getOption($option)
    {
        if (!isset($this->options[$option])) {
            return null;
        }
        return $this->options[$option];
    }
}
