<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PedidosFixture
 *
 */
class PedidosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'cliente_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'data_pedido' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'previsao_entrega' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data_entrega' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'situacao' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'observacao' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
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
                'cliente_id' => 1,
                'data_pedido' => 1554938817,
                'previsao_entrega' => 1554938817,
                'data_entrega' => 1554938817,
                'situacao' => 1,
                'observacao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ],
        ];
        parent::init();
    }
}
