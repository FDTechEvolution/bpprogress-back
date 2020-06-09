<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsedWarehousesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsedWarehousesTable Test Case
 */
class UsedWarehousesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsedWarehousesTable
     */
    public $UsedWarehouses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UsedWarehouses',
        'app.OrderLines',
        'app.Warehouses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsedWarehouses') ? [] : ['className' => UsedWarehousesTable::class];
        $this->UsedWarehouses = TableRegistry::getTableLocator()->get('UsedWarehouses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsedWarehouses);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
