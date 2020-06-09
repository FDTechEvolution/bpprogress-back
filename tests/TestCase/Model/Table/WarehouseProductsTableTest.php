<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WarehouseProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WarehouseProductsTable Test Case
 */
class WarehouseProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WarehouseProductsTable
     */
    public $WarehouseProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.WarehouseProducts',
        'app.Warehouses',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WarehouseProducts') ? [] : ['className' => WarehouseProductsTable::class];
        $this->WarehouseProducts = TableRegistry::getTableLocator()->get('WarehouseProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WarehouseProducts);

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
