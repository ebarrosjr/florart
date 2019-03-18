<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LotesTable Test Case
 */
class LotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LotesTable
     */
    public $Lotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Lotes',
        'app.Fabricacao'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Lotes') ? [] : ['className' => LotesTable::class];
        $this->Lotes = TableRegistry::getTableLocator()->get('Lotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lotes);

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
