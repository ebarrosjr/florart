<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FabricacaoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FabricacaoTable Test Case
 */
class FabricacaoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FabricacaoTable
     */
    public $Fabricacao;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Fabricacao',
        'app.Produtos',
        'app.UnidadeMedidas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Fabricacao') ? [] : ['className' => FabricacaoTable::class];
        $this->Fabricacao = TableRegistry::getTableLocator()->get('Fabricacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fabricacao);

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
