<?php

use Migrations\AbstractMigration;

class CreateEventBookingOptionValues extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_booking_option_values');
        $table->addColumn('event_booking_option_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('opt_value', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->addIndex([
            'event_booking_option_id',
                ], [
            'name' => 'BY_EVENT_BOOKING_OPTION_ID',
            'unique' => false,
        ]);

        $table->addForeignKey('event_booking_option_id', 'event_booking_options', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
