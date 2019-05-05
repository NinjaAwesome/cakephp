<?php

use Migrations\AbstractMigration;

class CreateEventOptionValues extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_option_values');
        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('evoption_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('event_option_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('evoptions_value_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('option_value', 'text', [
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
        $table->addIndex([
            'event_id',
                ], [
            'name' => 'BY_EVENT_ID',
            'unique' => false,
        ]);

        $table->addForeignKey('event_id', 'events', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);
        $table->addForeignKey('event_option_id', 'event_options', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);
        $table->addForeignKey('evoption_id', 'evoptions', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);
        $table->addForeignKey('evoptions_value_id', 'evoption_values', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
