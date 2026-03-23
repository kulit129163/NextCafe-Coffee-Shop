<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixReviewsTable extends Migration
{
    public function up()
    {
        $fields = [
            'review_text' => [
                'name' => 'comment',
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('reviews', $fields);
    }

    public function down()
    {
        $fields = [
            'comment' => [
                'name' => 'review_text',
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('reviews', $fields);
    }
}
