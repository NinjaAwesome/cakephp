<?php

use Migrations\AbstractMigration;

class CreateEventBookingOptions extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_booking_options');
        $table->addColumn('event_booking_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('evoption_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->addColumn('option_value', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('option_type', 'string', [
            'default' => null,
            'limit' => 50,
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

        $table->addForeignKey('event_booking_id', 'event_bookings', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);
        $table->addForeignKey('evoption_id', 'evoptions', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
