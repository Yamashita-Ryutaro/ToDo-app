<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mail\MstSystemMailKey;

class MstSystemMailKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MstSystemMailKey::create([
            'display_name' => 'URLキー',
            'key' => '##URL##',
        ]);

        MstSystemMailKey::create([
            'display_name' => 'TASKキー',
            'key' => '##TASK##',
        ]);
    }
}