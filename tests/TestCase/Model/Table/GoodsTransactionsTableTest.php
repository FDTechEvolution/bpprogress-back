<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoodsTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoodsTransactionsTable Test Case
 */
class GoodsTransactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GoodsTransactionsTable
     */
    public $GoodsTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GoodsTransactions',
        'app.Users',
        'app.Warehouses',
        'app.GoodsLines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GoodsTransactions') ? [] : ['className' => GoodsTransactionsTable::class];
        $this->GoodsTransactions = TableRegistry::getTableLocator()->get('GoodsTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GoodsTransactions);

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
