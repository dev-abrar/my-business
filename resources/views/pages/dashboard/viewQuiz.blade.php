@extends('layouts.sideNav')

@section('content')

    @include('components.quiz.quizList')
    @include('components.quiz.createQuiz')
    @include('components.quiz.editQuiz')
@endsection

@section('footer_script')
    @include('components.quiz.quizJs')
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection