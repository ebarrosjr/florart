<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoMateriaPrimasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoMateriaPrimasTable Test Case
 */
class TipoMateriaPrimasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoMateriaPrimasTable
     */
    public $TipoMateriaPrimas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TipoMateriaPrimas',
        'app.MateriaPrimas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TipoMateriaPrimas') ? [] : ['className' => TipoMateriaPrimasTable::class];
        $this->TipoMateriaPrimas = TableRegistry::getTableLocator()->get('TipoMateriaPrimas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoMateriaPrimas);

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
