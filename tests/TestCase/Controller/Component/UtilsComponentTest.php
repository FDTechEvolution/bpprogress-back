<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UtilsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UtilsComponent Test Case
 */
class UtilsComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\UtilsComponent
     */
    public $Utils;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Utils = new UtilsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Utils);

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
