<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MateriaPrimasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MateriaPrimasTable Test Case
 */
class MateriaPrimasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MateriaPrimasTable
     */
    public $MateriaPrimas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MateriaPrimas',
        'app.TipoMateriaPrimas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MateriaPrimas') ? [] : ['className' => MateriaPrimasTable::class];
        $this->MateriaPrimas = TableRegistry::getTableLocator()->get('MateriaPrimas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MateriaPrimas);

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
