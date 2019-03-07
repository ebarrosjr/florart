<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SituacaosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SituacaosTable Test Case
 */
class SituacaosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SituacaosTable
     */
    public $Situacaos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Situacaos',
        'app.ItensNotas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Situacaos') ? [] : ['className' => SituacaosTable::class];
        $this->Situacaos = TableRegistry::getTableLocator()->get('Situacaos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Situacaos);

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
