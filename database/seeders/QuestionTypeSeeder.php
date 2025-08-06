<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuestionType::create(['name' => 'paragraph']);
        QuestionType::create(['name' => 'multiple-choice']);
        QuestionType::create(['name' => 'checkbox']);
        QuestionType::create(['name' => 'dropdown']);
        QuestionType::create(['name' => 'linear-scale']);
        QuestionType::create(['name' => 'date']);
        QuestionType::create(['name' => 'time']);
        QuestionType::create(['name' => 'file-upload']);
    }
}
