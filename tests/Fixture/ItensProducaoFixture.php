<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItensProducaoFixture
 *
 */
class ItensProducaoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'itens_producao';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'manufatura_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'materia_prima_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'prefabricacao_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'quantidade' => ['type' => 'float', 'length' => 15, 'precision' => 2, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => ''],
        'valor_combinado' => ['type' => 'float', 'length' => 15, 'precision' => 2, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => ''],
        'unitario' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data_inicio' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data_fim' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'valor_pago' => ['type' => 'float', 'length' => 15, 'precision' => 2, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => ''],
        'forma_pagamento_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'manufatura_id' => 1,
                'materia_prima_id' => 1,
                'prefabricacao_id' => 1,
                'user_id' => 1,
                'quantidade' => 1,
                'valor_combinado' => 1,
                'unitario' => 1,
                'data_inicio' => 1552830045,
                'data_fim' => 1552830045,
                'valor_pago' => 1,
                'forma_pagamento_id' => 1
            ],
        ];
        parent::init();
    }
}
