<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItensNotasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItensNotasTable Test Case
 */
class ItensNotasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItensNotasTable
     */
    public $ItensNotas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ItensNotas',
        'app.Notas',
        'app.UnidadeMedidas',
        'app.Situacaos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItensNotas') ? [] : ['className' => ItensNotasTable::class];
        $this->ItensNotas = TableRegistry::getTableLocator()->get('ItensNotas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItensNotas);

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
