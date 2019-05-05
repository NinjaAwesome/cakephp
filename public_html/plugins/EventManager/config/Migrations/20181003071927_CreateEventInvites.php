<?php

use Migrations\AbstractMigration;

class CreateEventInvites extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_invites');
        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('sessionId', 'string', [
            'default' => null,
            'limit' => 500,
            'null' => false,
        ]);
        
        $table->addColumn('status_in', 'boolean', [
            'default' => null,
            'null' => false,
            'comment'=>'"0"="Interested","1"="Going","2"="May Be"',
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
        
        $table->create();
    }

}
