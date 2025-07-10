<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'        => '',
        'hostname'   => '', // Will be set from .env
        'username'   => '', // Will be set from .env
        'password'   => '', // Will be set from .env
        'database'   => '', // Will be set from .env
        'DBDriver'   => 'Postgre',
        'DBPrefix'   => '',
        'pConnect'   => false,
        'DBDebug'    => false, // Will be set from .env or ENVIRONMENT
        'charset'    => 'utf8',
        'DBCollat'   => 'utf8_general_ci',
        'swapPre'    => '',
        'encrypt'    => false,
        'compress'   => false,
        'strictOn'   => false,
        'failover'   => [],
        'port'       => 6543,
        'dateFormat' => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Load environment variables for database connection
        $this->default['hostname'] = getenv('database.default.hostname');
        $this->default['username'] = getenv('database.default.username');
        $this->default['password'] = getenv('database.default.password');
        $this->default['database'] = getenv('database.default.database');
        $this->default['DBDebug']  = ENVIRONMENT !== 'production';

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
