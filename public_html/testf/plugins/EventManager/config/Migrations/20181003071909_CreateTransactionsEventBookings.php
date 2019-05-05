<?php

use Migrations\AbstractMigration;

class CreateTransactionsEventBookings extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('transactions_event_bookings');
        $table->addColumn('event_booking_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('transaction_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->addIndex([
            'event_booking_id',
                ], [
            'name' => 'BY_EVENT_BOOKING_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'transaction_id',
                ], [
            'name' => 'BY_TRANSACTION_ID',
            'unique' => false,
        ]);

        $table->addForeignKey('event_booking_id', 'event_bookings', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);
        $table->addForeignKey('transaction_id', 'transactions', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
