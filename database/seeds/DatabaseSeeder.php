<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // 生成管理员数据
//         $this->call(UserSeeder::class);
        // 生成文章数据
        $this->call(ArticleSeeder::class);
    }
}
