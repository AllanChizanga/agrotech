<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\Question;
use App\Models\Option;
use App\Models\Respondent;
use App\Models\Response;
use App\Models\Answer;
use App\Models\QuestionType;
use App\Models\User;

class DemoSurveySeeder extends Seeder
{
    public function run(): void
    {
        // Create a user for the form
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        // Create a survey form
        $form = Form::create([
            'user_id' => $user->id,
            'title' => 'Demo Survey',
            'description' => 'A demo survey with various question types.',
            'category' => 'Demo',
            'status' => 'published',
            'is_public' => true,
        ]);

        // Pick 7 different question types
        $types = [
            'paragraph', 'short-answer', 'multiple-choice', 'checkbox', 'dropdown', 'date', 'numerical-integer'
        ];

        // Create 7 questions
        $questions = [];
        foreach ($types as $i => $type) {
            $questions[$i] = Question::create([
                'form_id' => $form->id,
                'question_text' => "Question " . ($i + 1) . " (" . $type . ")",
                'question_type' => $type,
                'is_required' => true,
                'question_order' => $i + 1,
            ]);

            // Add options for choice questions
            if (in_array($type, ['multiple-choice', 'checkbox', 'dropdown'])) {
                foreach (['Option A', 'Option B', 'Option C'] as $j => $opt) {
                    Option::create([
                        'question_id' => $questions[$i]->id,
                        'option_text' => $opt,
                        'option_order' => $j + 1,
                    ]);
                }
            }
        }

        // Create 10 respondents
        $respondents = [];
        for ($i = 1; $i <= 10; $i++) {
            $respondents[$i] = Respondent::create([
                'fullname' => "Respondent $i",
                'national_id' => "NID$i" . rand(1000,9999),
                'phone' => "0700$i" . rand(100,999),
                'address' => "Address $i",
                'country' => "Country $i",
                'city' => "City $i",
                'email' => "respondent$i@example.com",
            ]);
        }

        // Create a response for each respondent
        foreach ($respondents as $resp) {
            $response = Response::create([
                'form_id' => $form->id,
                'respondent_id' => $resp->id,
            ]);

            // Create answers for each question
            foreach ($questions as $question) {
                $type = $question->question_type;
                $answerData = [
                    'response_id' => $response->id,
                    'question_id' => $question->id,
                ];

                if (in_array($type, ['multiple-choice', 'dropdown'])) {
                    // Pick one option
                    $option = $question->options()->inRandomOrder()->first();
                    $answerData['option_id'] = $option->id;
                    $answerData['answer_text'] = $option->option_text;
                } elseif ($type === 'checkbox') {
                    // Pick one or two options (simulate multiple answers)
                    $option = $question->options()->inRandomOrder()->first();
                    $answerData['option_id'] = $option->id;
                    $answerData['answer_text'] = $option->option_text;
                } elseif ($type === 'paragraph') {
                    $answerData['answer_text'] = "This is a paragraph answer from {$resp->fullname}.";
                } elseif ($type === 'short-answer') {
                    $answerData['answer_text'] = "Short answer $i";
                } elseif ($type === 'date') {
                    $answerData['answer_text'] = now()->subDays(rand(0, 30))->toDateString();
                } elseif ($type === 'numerical-integer') {
                    $answerData['answer_text'] = rand(1, 100);
                } else {
                    $answerData['answer_text'] = "Sample answer";
                }

                Answer::create($answerData);
            }
        }
    }
}