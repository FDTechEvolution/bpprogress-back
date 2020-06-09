<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\DocumentSequentComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\DocumentSequentComponent Test Case
 */
class DocumentSequentComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\DocumentSequentComponent
     */
    public $DocumentSequent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->DocumentSequent = new DocumentSequentComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DocumentSequent);

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
