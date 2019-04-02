<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PflivresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PflivresTable Test Case
 */
class PflivresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PflivresTable
     */
    public $Pflivres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pflivres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pflivres') ? [] : ['className' => PflivresTable::class];
        $this->Pflivres = TableRegistry::getTableLocator()->get('Pflivres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pflivres);

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
}
