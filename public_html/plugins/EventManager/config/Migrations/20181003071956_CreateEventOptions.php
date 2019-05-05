<?php

use Migrations\AbstractMigration;

class CreateEventOptions extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_options');
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
        $table->addColumn('value', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('is_required', 'boolean', [
            'default' => null,
            'null' => false,
            'comment' => '"1"="Yes","0"="No"',
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
        $table->addForeignKey('evoption_id', 'evoptions', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
