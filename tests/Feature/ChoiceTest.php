<?php

use App\Models\Choice;
use App\Models\Exam;
use App\Models\Question;

test('a question has many choices and a choice belongs to a question', function () {
    $exam = new Exam;
    $exam->name = 'Ruby Silver';
    $exam->save();

    $question = new Question;
    $question->exam()->associate($exam);
    $question->body = '問題文';
    $question->explanation = '解説';
    $question->save();

    $choice = new Choice;
    $choice->body = '選択肢';
    $choice->is_correct = true;
    $question->choices()->save($choice);

    expect($question->choices)->toHaveCount(1)
        ->and($question->choices->first()->is($choice))->toBeTrue()
        ->and($choice->question->is($question))->toBeTrue();
});

test('deleting a question also deletes its choices', function () {
    $exam = new Exam;
    $exam->name = 'Ruby Silver';
    $exam->save();

    $question = new Question;
    $question->exam()->associate($exam);
    $question->body = '問題文';
    $question->explanation = '解説';
    $question->save();

    $choice = new Choice;
    $choice->body = '選択肢';
    $choice->is_correct = false;
    $question->choices()->save($choice);

    $question->delete();

    $this->assertDatabaseMissing('choices', ['id' => $choice->id]);
});
