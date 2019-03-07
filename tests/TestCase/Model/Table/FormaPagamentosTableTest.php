<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormaPagamentosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormaPagamentosTable Test Case
 */
class FormaPagamentosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormaPagamentosTable
     */
    public $FormaPagamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FormaPagamentos',
        'app.Compras'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FormaPagamentos') ? [] : ['className' => FormaPagamentosTable::class];
        $this->FormaPagamentos = TableRegistry::getTableLocator()->get('FormaPagamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormaPagamentos);

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
