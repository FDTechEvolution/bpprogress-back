<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PaymentComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PaymentComponent Test Case
 */
class PaymentComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\PaymentComponent
     */
    public $Payment;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Payment = new PaymentComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Payment);

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
