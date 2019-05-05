<?php
use Migrations\AbstractMigration;

class CreateEventDocuments extends AbstractMigration
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
        $table = $this->table('event_documents');
        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        
        $table->addColumn('file_type', 'boolean', [
            'default' => null,
            'null' => false,
            'comment' => '"1"="Image","2"="Video"',
        ]);
        
        $table->addColumn('file_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('caption', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
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
            'event_id',
        ], [
            'name' => 'BY_EVENT_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'sort_order',
        ], [
            'name' => 'BY_SORT_ORDER',
            'unique' => false,
        ]);
        $table->create();
    }
}
