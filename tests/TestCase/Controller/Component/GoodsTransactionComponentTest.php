<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\GoodsTransactionComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\GoodsTransactionComponent Test Case
 */
class GoodsTransactionComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\GoodsTransactionComponent
     */
    public $GoodsTransaction;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->GoodsTransaction = new GoodsTransactionComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GoodsTransaction);

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
