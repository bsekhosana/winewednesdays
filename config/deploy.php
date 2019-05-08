<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default deployment strategy
    |--------------------------------------------------------------------------
    |
    | This option defines which deployment strategy to use by default on all
    | of your hosts. Laravel Deployer provides some strategies out-of-box
    | for you to choose from explained in detail in the documentation.
    |
    | Supported: 'basic', 'firstdeploy', 'local', 'pull'.
    |
    */

    'default' => 'basic',

    /*
    |--------------------------------------------------------------------------
    | Custom deployment strategies
    |--------------------------------------------------------------------------
    |
    | Here, you can easily set up new custom strategies as a list of tasks.
    | Any key of this array are supported in the `default` option above.
    | Any key matching Laravel Deployer's strategies overrides them.
    |
    */

    'strategies' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    |
    | Hooks let you customize your deployments conveniently by pushing tasks
    | into strategic places of your deployment flow. Each of the official
    | strategies invoke hooks in different ways to implement their logic.
    |
    */

    'hooks' => [
        // Right before we start deploying.
        'start'   => [
            //
        ],

        // Code and composer vendors are ready but nothing is built.
        'build'   => [
            'npm:install',
//            'npm:production',
        ],

        // Deployment is done but not live yet (before symlink)
        'ready'   => [
            'artisan:storage:link',
            'artisan:optimize',
            'artisan:migrate',
//            'artisan:horizon:terminate',
        ],

        // Deployment is done and live
        'done'    => [
            'fpm:reload',
        ],

        // Deployment succeeded.
        'success' => [
            //
        ],

        // Deployment failed.
        'fail'    => [
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Deployment options
    |--------------------------------------------------------------------------
    |
    | Options follow a simple key/value structure and are used within tasks
    | to make them more configurable and reusable. You can use options to
    | configure existing tasks or to use whithin your own custom tasks.
    |
    */

    'options' => [
        'application'              => env('APP_NAME'),
        'repository'               => env('DEPLOYER_REPO'),
        'branch'                   => env('DEPLOYER_BRANCH', 'master'),
        'php_fpm_service'          => env('DEPLOYER_FPM', 'php7.2-fpm'),
        'default_timeout'          => 360,
        'keep_releases'            => 3,
        'release_name'             => date('YmdHi'),
        'composer_action'          => 'install',
        'composer_options'         => '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader',
        'ssh_multiplexing'         => true,
        'writable_use_sudo'        => false,
        'writable_chmod_recursive' => true,
        'writable_chmod_mode'      => 755,
        'writable_mode'            => 'chmod',
        'writable_dirs'            => [
            'bootstrap/cache',
            'storage',
        ],
        'shared_files'             => [
            '.env',
        ],
        'shared_dirs'              => [
            'storage',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hosts
    |--------------------------------------------------------------------------
    |
    | Here, you can define any domain or sub-domain you want to deploy to.
    | You can provide them with roles and stages to filter them during
    | deployment. Read more about how to configure them in the docs.
    |
    */

    'hosts' => [
        '104.248.90.217'  => [
            'deploy_path'  => env('DEPLOYER_PATH'),
            'user'         => 'laravel',
            'identityFile' => '~/.ssh/id_rsa',
            'forwardAgent' => true,
            'multiplexing' => true,
            'sshOptions'   => [
                'UserKnownHostsFile'    => '/dev/null',
                'StrictHostKeyChecking' => 'no',
            ],
            'roles' => 'prod',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Localhost
    |--------------------------------------------------------------------------
    |
    | This localhost option give you the ability to deploy directly on your
    | local machine, without needing any SSH connection. You can use the
    | same configurations used by hosts to configure your localhost.
    |
    */

    'localhost' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Include additional Deployer recipes
    |--------------------------------------------------------------------------
    |
    | Here, you can add any third party recipes to provide additional tasks,
    | options and strategies. Therefore, it also allows you to create and
    | include your own recipes to define more complex deployment flows.
    |
    */

    'include' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Use a custom Deployer file
    |--------------------------------------------------------------------------
    |
    | If you know what you are doing and want to take complete control over
    | Deployer's file, you can provide its path here. Note that, without
    | this configuration file, the root's deployer file will be used.
    |
    */

    'custom_deployer_file' => false,

];
