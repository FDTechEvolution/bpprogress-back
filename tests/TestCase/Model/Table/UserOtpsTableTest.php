<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserOtpsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserOtpsTable Test Case
 */
class UserOtpsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserOtpsTable
     */
    public $UserOtps;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserOtps',
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
        $config = TableRegistry::getTableLocator()->exists('UserOtps') ? [] : ['className' => UserOtpsTable::class];
        $this->UserOtps = TableRegistry::getTableLocator()->get('UserOtps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserOtps);

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
