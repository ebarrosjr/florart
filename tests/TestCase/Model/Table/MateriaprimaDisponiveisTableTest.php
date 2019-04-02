<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MateriaprimaDisponiveisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MateriaprimaDisponiveisTable Test Case
 */
class MateriaprimaDisponiveisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MateriaprimaDisponiveisTable
     */
    public $MateriaprimaDisponiveis;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MateriaprimaDisponiveis'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MateriaprimaDisponiveis') ? [] : ['className' => MateriaprimaDisponiveisTable::class];
        $this->MateriaprimaDisponiveis = TableRegistry::getTableLocator()->get('MateriaprimaDisponiveis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MateriaprimaDisponiveis);

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
