<?php
return array(
    'zfcuseracl' => array(
        'role_model_class' => 'ZfcUserAcl\Model\RoleBase',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                // By default, use the ZfcUser db connection
                'zfcuseracl_write_db'    => 'zfcuser_write_db',
                'zfcuseracl_read_db'     => 'zfcuser_read_db',
                'zfcuseracl_role_mapper' => 'ZfcUserAcl\Model\Mapper\RoleZendDb',
                'zfcuseracl_mvc_listener' => 'ZfcUserAcl\Listener\MvcDispatchListener',

            ),
            'zfcuseracl_mvc_listener' => array(
                'parameters' => array(
                    'aclService' => '',
                ),
            ),
            'zfcuseracl_role_mapper' => array(
                'parameters' => array(
                    'readAdapter'  => 'zfcuseracl_read_db',
                    'writeAdapter' => 'zfcuseracl_write_db',
                ),
            ),
        ),
    ),
);
