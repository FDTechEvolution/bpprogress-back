<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoodsLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoodsLinesTable Test Case
 */
class GoodsLinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GoodsLinesTable
     */
    public $GoodsLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GoodsLines',
        'app.GoodsTransactions',
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
        $config = TableRegistry::getTableLocator()->exists('GoodsLines') ? [] : ['className' => GoodsLinesTable::class];
        $this->GoodsLines = TableRegistry::getTableLocator()->get('GoodsLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GoodsLines);

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
