<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrupoProdutosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrupoProdutosTable Test Case
 */
class GrupoProdutosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GrupoProdutosTable
     */
    public $GrupoProdutos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GrupoProdutos',
        'app.Produtos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GrupoProdutos') ? [] : ['className' => GrupoProdutosTable::class];
        $this->GrupoProdutos = TableRegistry::getTableLocator()->get('GrupoProdutos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GrupoProdutos);

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
