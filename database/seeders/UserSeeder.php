<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // 图片数组
        $photos = [
            'default_photo.jpeg',
            'WechatIMG47.jpg',
            'WechatIMG48.jpg',
            'WechatIMG49.jpg',
            'WechatIMG50.jpg',
            'WechatIMG51.jpg',
            'WechatIMG52.jpg',
            'WechatIMG53.jpg',
            'WechatIMG54.jpg',
            'WechatIMG55.jpg'
        ];

        foreach(range(1, 100) as $index) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // 默认密码
                'name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'photo' => $faker->randomElement($photos), // 从图片数组中随机选择一个
                'university' => $faker->company,
                'degree' => $faker->randomElement(['Bachelor', 'Master', 'PhD']),
                'year' => $faker->year,
                'dob' => $faker->date(),
                'personal_description' => $faker->sentence,
                'skills' => $faker->words(3, true), // 三个技能词语
                'hobbies' => $faker->words(3, true), // 三个爱好词语
                'enrollment_type' => $faker->randomElement(['Full-time', 'Part-time']),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
