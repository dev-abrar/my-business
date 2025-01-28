@extends('layouts.master')
@section('title', 'Quiz Results')

@section('style')
    <style>
       
       #quizRes h1 {
            color: #88B04B;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
            text-align: center
        }
       #quizRes p {
            color: #404F5E;
            font-size: 20px;
            margin: 0;
            text-align: center
        }
       #quizRes i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
       #quizRes .card {
            padding: 60px;
            border-radius: 4px;
            display: inline-block;
            margin: 0 auto;
            
          
            }
            #quizRes{
                padding: 40px 0px;
            }
    </style>
@endsection

@section('content')
@include('pages.frontend.partial.studentNav')

<!-- ====================== quiz results ================= -->
<section id="quizRes">
  @if (Auth::guard('studentlogin')->user()->sts==1)
  <div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                  <i class="checkmark">✓</i>
                </div>
                <h1>Success</h1>
                <p>Your Quiz Results:<br/>
                  Total Correct Answers: {{ $submission->correct_answers_count }} / {{ count(json_decode($submission->answers)) }}<br/>
                  Thank you for completing the quize!
                </p>
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

<!-- ====================== quiz results end ================= -->
@endsection

@section('footer_script')
<script>
    
</script>
@endsection
