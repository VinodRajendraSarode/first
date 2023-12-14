<?php
namespace Seipkon\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Seipkon\View\Helper\SeipkonHelper;

/**
 * Seipkon\View\Helper\SeipkonHelper Test Case
 */
class SeipkonHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Seipkon\View\Helper\SeipkonHelper
     */
    public $Seipkon;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Seipkon = new SeipkonHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Seipkon);

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
