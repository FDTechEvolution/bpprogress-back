<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreorderRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreorderRatesTable Test Case
 */
class PreorderRatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PreorderRatesTable
     */
    public $PreorderRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PreorderRates',
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
        $config = TableRegistry::getTableLocator()->exists('PreorderRates') ? [] : ['className' => PreorderRatesTable::class];
        $this->PreorderRates = TableRegistry::getTableLocator()->get('PreorderRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PreorderRates);

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
