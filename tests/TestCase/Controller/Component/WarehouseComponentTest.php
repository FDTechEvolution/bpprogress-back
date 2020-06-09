<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\WarehouseComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\WarehouseComponent Test Case
 */
class WarehouseComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\WarehouseComponent
     */
    public $Warehouse;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Warehouse = new WarehouseComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Warehouse);

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
