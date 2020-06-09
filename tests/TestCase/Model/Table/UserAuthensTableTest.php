<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserAuthensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserAuthensTable Test Case
 */
class UserAuthensTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserAuthensTable
     */
    public $UserAuthens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserAuthens',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserAuthens') ? [] : ['className' => UserAuthensTable::class];
        $this->UserAuthens = TableRegistry::getTableLocator()->get('UserAuthens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserAuthens);

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
