<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddThumbnailToPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'body',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'thumbnail');
    }
}
