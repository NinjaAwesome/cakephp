<?php
use Migrations\AbstractMigration;

class CreateEvents extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('events');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('short_description', 'string', [
            'default' => null,
            'limit' => 400,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('location', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('organizar_name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('organizer_email', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('banner_image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('amount', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('max_participants', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('start_date', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('end_date', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('meta_title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('meta_keyword', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('meta_description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_join', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_register', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_paid', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
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
            'user_id',
        ], [
            'name' => 'BY_USER_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'is_join',
        ], [
            'name' => 'BY_IS_JOIN',
            'unique' => false,
        ]);
        $table->addIndex([
            'is_register',
        ], [
            'name' => 'BY_IS_REGISTER',
            'unique' => false,
        ]);
        $table->addIndex([
            'is_paid',
        ], [
            'name' => 'BY_IS_PAID',
            'unique' => false,
        ]);
        $table->create();
    }
}
