@extends('layouts.master')
@section('title', 'Our Quiz')
@section('style')
<style>
    #nextButton, #previousButton, #submitButton {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    #nextButton, #previousButton, #submitButton {
        display: none;
        margin-top: 15px;
    }

    #nextButton:active, #previousButton:active, #submitButton:active {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
@include('pages.frontend.partial.studentNav')

<!-- ====================== quiz start================= -->
<section id="quize">
    @if (Auth::guard('studentlogin')->user()->sts==1)
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="quize_box">
                    <h5>Quiz Exam</h5>
                    <!-- Show initial score -->
                    <div id="score" class="mb-3 text-center">Your Score: {{ $initialScore }}</div>
                    <div id="timer" class="mb-3 text-center">Time Left: 15:00</div>
                    <div class="quize_btn text-center">
                        <button id="startButton" class="start_btn m-auto">Let's Start</button>
                    </div>
                    <div id="questions" class="mt-3">
                        <!-- Loop through questions passed from the controller -->
                        @foreach($questions as $index => $question)
                            <div class="question" id="question{{ $index }}">
                                <h6>{{ $question->question_text }}</h6>
                                <div class="options">
                                    @foreach(json_decode($question->options) as $key => $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question{{ $index }}" id="option{{ $index }}_{{ $key }}" value="{{ $option }}">
                                            <label class="form-check-label" for="option{{ $index }}_{{ $key }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="nextButton" class="next_btn mt-3" style="display: none;">Next</button>
                    <button id="previousButton" class="next_btn mt-3" style="display: none;">Previous</button>
                    <button id="submitButton" class="next_btn mt-3" style="display: none;">Submit</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center">
        <h5 class="text-danger">You have varify your account to visit this page</h5>
    </div>
    @endif
</section>
<!-- ====================== quiz end================= -->
@endsection

@section('footer_script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questions = @json($questions);
    let currentQuestion = 0;
    let timeLeft = 15 * 60; // 15 minutes
    let timerInterval;

    const startButton = document.getElementById("startButton");
    const nextButton = document.getElementById("nextButton");
    const previousButton = document.getElementById("previousButton");
    const submitButton = document.getElementById("submitButton");
    const timerElement = document.getElementById("timer");
    const scoreElement = document.getElementById("score");
    const questionsContainer = document.getElementById("questions");

    // Store selected answers in an array
    const selectedAnswers = new Array(questions.length).fill(null);

    // Initialize the score display
    let score = 0;
    scoreElement.textContent = `Your Score: ${score} / ${questions.length}`;

    function startQuiz() {
        startButton.style.display = "none"; // Hide start button
        renderQuestion();  // Render the first question
        nextButton.style.display = "block"; // Show Next button
        previousButton.style.display = "none"; // Hide Previous button
        submitButton.style.display = "none"; // Hide Submit button
        startTimer(); // Start the timer
    }

    function renderQuestion() {
        const question = questions[currentQuestion];
        const options = JSON.parse(question.options);

        // Generate the options with the selected value pre-filled if any
        questionsContainer.innerHTML = `
            <div class="question active">
                <h6>${question.question_text}</h6>
                ${options.map((opt, index) =>
                    `<div class="form-check">
                        <input class="form-check-input" type="radio" name="question${currentQuestion}" id="option${currentQuestion}_${index}" value="${opt}" ${selectedAnswers[currentQuestion] === opt ? 'checked' : ''}>
                        <label class="form-check-label" for="option${currentQuestion}_${index}">${opt}</label>
                    </div>`
                ).join("")}
            </div>
        `;

        // Logic for buttons
        nextButton.style.display = currentQuestion < questions.length - 1 ? "block" : "none"; // Show Next button only if not on last question
        previousButton.style.display = currentQuestion > 0 ? "block" : "none"; // Show Previous button if not on first question
        submitButton.style.display = currentQuestion === questions.length - 1 ? "block" : "none"; // Show Submit button only on the last question
    }

    function nextQuestion() {
        // Save selected answer before moving to the next question
        const selectedOption = document.querySelector(`input[name="question${currentQuestion}"]:checked`);
        if (selectedOption) {
            selectedAnswers[currentQuestion] = selectedOption.value;
        }

        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            renderQuestion();
        }
    }

    function previousQuestion() {
        // Save selected answer before moving to the previous question
        const selectedOption = document.querySelector(`input[name="question${currentQuestion}"]:checked`);
        if (selectedOption) {
            selectedAnswers[currentQuestion] = selectedOption.value;
        }

        if (currentQuestion > 0) {
            currentQuestion--;
            renderQuestion();
        }
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                alert("Time is up!");
                submitAnswers();  // Automatically submit when time is up
            } else {
                timeLeft--;
                updateTimerDisplay();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `Time Left: ${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
    }

    // Submit answers
    function submitAnswers() {
        const answers = selectedAnswers;

        // Send the data using jQuery Ajax
        $.ajax({
            url: '{{ route('submit.answers') }}',  // Your Laravel route to submit the answers
            type: 'POST',
            data: {
                answers: answers,
                _token: '{{ csrf_token() }}'  // CSRF token to protect the request
            },
            success: function(response) {
                // Use Toastify for success message
                toastify().success(response.message);

                // Update the score
                score = response.correct_answers_count;
                scoreElement.textContent = `Your Score: ${score} / ${questions.length}`;
                window.location.href = '{{ route('quiz.results') }}'; // Redirect to results page
            },
            error: function(xhr, status, error) {
                toastify().error('There was an error submitting your answers. Please try again.');
                // Show an error toast
                
            }
        });
    }

    startButton.addEventListener("click", startQuiz);
    nextButton.addEventListener("click", nextQuestion);
    previousButton.addEventListener("click", previousQuestion);
    submitButton.addEventListener("click", submitAnswers);
});

</script>
@endsection
