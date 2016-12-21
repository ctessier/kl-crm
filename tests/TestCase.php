<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseMigrations;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Setup testing environment (run migrations and unguard models).
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->runDatabaseMigrations();
        $this->seed();
    }
    /**
     * Tear down testing environment.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}
