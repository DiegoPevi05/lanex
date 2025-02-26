<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateWebBlogsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('web_blogs')->truncate();
    }
}