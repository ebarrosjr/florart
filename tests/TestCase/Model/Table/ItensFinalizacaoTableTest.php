<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItensFinalizacaoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItensFinalizacaoTable Test Case
 */
class ItensFinalizacaoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItensFinalizacaoTable
     */
    public $ItensFinalizacao;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ItensFinalizacao',
        'app.Fabricacaos',
        'app.Manufaturas',
        'app.MateriaPrimas',
        'app.Prefabricacaos',
        'app.Users',
        'app.FormaPagamentos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItensFinalizacao') ? [] : ['className' => ItensFinalizacaoTable::class];
        $this->ItensFinalizacao = TableRegistry::getTableLocator()->get('ItensFinalizacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItensFinalizacao);

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
