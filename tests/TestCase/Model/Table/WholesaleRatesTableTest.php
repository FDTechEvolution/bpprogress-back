<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WholesaleRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WholesaleRatesTable Test Case
 */
class WholesaleRatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WholesaleRatesTable
     */
    public $WholesaleRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.WholesaleRates',
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
        $config = TableRegistry::getTableLocator()->exists('WholesaleRates') ? [] : ['className' => WholesaleRatesTable::class];
        $this->WholesaleRates = TableRegistry::getTableLocator()->get('WholesaleRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WholesaleRates);

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
