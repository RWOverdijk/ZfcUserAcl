<?php

namespace ZfcUserAcl\Listener;

use ZfcUserAcl\Module as ZfcUserAcl;

class MvcDispatchListener implements ZfcUserAclAware
{
    protected $aclService;

    protected $module;

    public function __construct(ZfcUserAcl $module)
    {
        // this is NULL. it should be 'ZfcUserAcl\Model\RoleBase'
        var_dump($module->getOption('role_model_class'));die(); // NULL
        $this->module = $module;
    }

    public function __invoke($e)
    {
        var_dump($e->getRouteMatch());
        die();
    }
 
    /**
     * Get aclService.
     *
     * @return aclService
     */
    public function getAclService()
    {
        return $this->aclService;
    }
 
    /**
     * Set aclService.
     *
     * @param $aclService the value to be set
     */
    public function setAclService($aclService)
    {
        $this->aclService = $aclService;
        return $this;
    }
}
