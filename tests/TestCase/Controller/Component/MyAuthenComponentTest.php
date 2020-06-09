<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\MyAuthenComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\MyAuthenComponent Test Case
 */
class MyAuthenComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\MyAuthenComponent
     */
    public $MyAuthen;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->MyAuthen = new MyAuthenComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MyAuthen);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
