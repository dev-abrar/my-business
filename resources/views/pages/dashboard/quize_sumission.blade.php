@extends('layouts.sideNav')

@section('content')
    @include('components.quiz.submissionList')
@endsection

@section('footer_script')
    @include('components.quiz.quizJs')
@endsection