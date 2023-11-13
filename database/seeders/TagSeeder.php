<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Advertisements','Consulting','Social media'];
        foreach ($tags as $tag) {
            Tag::create([
            'tags'=> $tag,
            ]);
    }
}
}