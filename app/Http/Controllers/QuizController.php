<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function viewQuiz()
    {

        $quizes = Question::all();

        $quizes = $quizes->map(function ($quiz) {

            $quiz->options = json_decode($quiz->options, true);
            return $quiz;
        });

        return view('pages.dashboard.viewQuiz', [
            'quizes' => $quizes,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        // Store the question data in the database
        $quiz = Question::create([
            'question_text' => $request->input('question'),
            'options' => json_encode($request->input('options')),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        // Redirect with success message
        return back()->with('success', 'Quiz question added successfully!');
    }

    public function update(Request $request)
    {
        // Validate the input data
        $request->validate([
            'id' => 'required|exists:questions,id',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        // Find the existing quiz question by ID
        $quiz = Question::find($request->input('id'));

        // Update the quiz data
        $quiz->question_text = $request->input('question');
        $quiz->options = json_encode($request->input('options'));
        $quiz->correct_answer = $request->input('correct_answer');

        // Save the updated quiz
        $quiz->save();

        // Redirect with success message
        return back()->with('success', 'Quiz question updated successfully!');
    }
    // In your QuizController.php

    public function destroy($id)
    {
        try {
            $quiz = Question::findOrFail($id);
            $quiz->delete();

            return response()->json(['success' => true, 'message' => 'Quiz deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting quiz.'], 500);
        }
    }

    public function showQuiz()
    {
        $studentId = Auth::guard('studentlogin')->user()->id;
        $previousSubmission = Answer::where('student_id', $studentId)->first();

        // If the student has already completed the quiz, don't show it again
        if ($previousSubmission) {
            return redirect()->route('quiz.results'); // Redirect to the results page
        }

        $questions = Question::all();
        $totalQuestions = $questions->count();
        $initialScore = '0/' . $totalQuestions;

        return view('pages.frontend.student.our_quize', compact('questions', 'initialScore'));
    }

    public function submitAnswers(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable|string',
        ]);

        // Get the authenticated student's ID
        $studentId = Auth::guard('studentlogin')->user()->id;

        // Get the questions from the database
        $questions = Question::all();

        // Retrieve the student's answers from the request
        $studentAnswers = $request->answers;

        // Calculate the number of correct answers
        $correctAnswersCount = 0;

        foreach ($questions as $index => $question) {
            // Compare student's answer with the correct answer for each question
            if (isset($studentAnswers[$index]) && $studentAnswers[$index] === $question->correct_answer) {
                $correctAnswersCount++;
            }
        }

        // Store the student's answers and the correct answer count
        $answer = Answer::create([
            'student_id' => $studentId,
            'answers' => json_encode($studentAnswers), // Store answers as JSON
            'correct_answers_count' => $correctAnswersCount,
        ]);

        // Return a response with the number of correct answers
        return response()->json([
            'message' => 'Your answers have been submitted successfully!',
            'correct_answers_count' => $correctAnswersCount,
        ]);
    }


    public function showResults()
    {
        // Get the authenticated student's ID
        $studentId = Auth::guard('studentlogin')->user()->id;

        // Get the student's submission from the database
        $submission = Answer::where('student_id', $studentId)->first();

        // If the student hasn't submitted the quiz yet, redirect to the quiz page
        if (!$submission) {
            return redirect()->route('quiz.index'); // or another route for the quiz
        }

        // Pass the submission data to the view
        return view('pages.frontend.student.quiz_results', compact('submission'));
    }

    public function submission(){
        $submits = Answer::latest()->paginate(30);
        return view('pages.dashboard.quize_sumission', compact('submits'));
    }

    public function submit_destroy($id)
    {
        try {
            $quiz = Answer::findOrFail($id);
            $quiz->delete();

            return response()->json(['success' => true, 'message' => 'Submission deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting quiz.'], 500);
        }
    }

}
