<?php

use Migrations\AbstractMigration;

class CreateTransactions extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('transactions');
        $table->addColumn('amount', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('service_provider_amount', 'decimal', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('payment_method', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);

        $table->addColumn('transaction_status', 'boolean', [
            'default' => null,
            'null' => true,
            'comment' => '"0"="A","1"="B","2"="C",,"3"="D"',
        ]);

        $table->addColumn('transactionId', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('transaction_responce', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }

}
