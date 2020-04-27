<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UploadImageComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UploadImageComponent Test Case
 */
class UploadImageComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\UploadImageComponent
     */
    public $UploadImage;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UploadImage = new UploadImageComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UploadImage);

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
