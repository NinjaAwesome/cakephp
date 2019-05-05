<?php

use Migrations\AbstractMigration;

class CreateEventReviews extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('event_reviews');
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
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('rating', 'integer', [
            'default' => null,
            'limit' => 2,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => false,
            'comment' => '"0"="De-active","1"="Active"',
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
        $table->addIndex([
            'user_id',
                ], [
            'name' => 'BY_USER_ID',
            'unique' => false,
        ]);

        $table->addForeignKey('event_id', 'events', ['id'], ['delete' => 'RESTRICT', 'update' => 'RESTRICT']);

        $table->create();
    }

}
