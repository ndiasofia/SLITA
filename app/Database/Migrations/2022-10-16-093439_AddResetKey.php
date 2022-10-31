<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetKey extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengguna', [
			'reset_key VARCHAR(255)'
		]);
    }

    public function down()
    {
        $this->forge->dropColumn('pengguna', 'reset_key');
    }
}
