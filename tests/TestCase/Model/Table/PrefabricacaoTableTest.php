<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrefabricacaoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrefabricacaoTable Test Case
 */
class PrefabricacaoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrefabricacaoTable
     */
    public $Prefabricacao;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Prefabricacao',
        'app.Produtos',
        'app.GrupoProdutos',
        'app.TipoProdutos',
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
        $config = TableRegistry::getTableLocator()->exists('Prefabricacao') ? [] : ['className' => PrefabricacaoTable::class];
        $this->Prefabricacao = TableRegistry::getTableLocator()->get('Prefabricacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prefabricacao);

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
