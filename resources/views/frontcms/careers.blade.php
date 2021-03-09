@extends('frontcms.layouts.master')
@section('title', 'Freshktm | Fresh Produce B to B Supply Chain' )
@section('styles')
<style>
    /* CAREERS */

    .careers {
      width: 80%;
      margin: auto;
      padding-bottom: 5%;

    }

    .careers-nav {
      padding-top: 5%;
    }

    .careers-nav a {
      background-color: #4a9e4a;
      border: none;
      border-radius: 25px;
      padding: 2% 4%;
      font-size: 16px;
      outline: none;
    }

    .careers-nav a:hover {
      background-color: #4a9e4a !important;
    }

    .career-section {
      width: 80%;
      margin: auto;
    }

    .career-section p {
      font-size: 18px;

      margin: auto;
      text-align: justify;
    }

    .career-opening {
      margin-top: 4%;
    }

    .job-title h4 {
      font-size: 16px !important;
    }

    .job-title a {
      background: #4a9e4a !important;
    }

    .job-description {
      padding-left: 5%;
    }

    .job-detail {}

    .job-apply {
      background: #2393d1 !important;
      border: none;
    }

    @media only screen and (max-width:767px) {

      .careers-nav {
        text-align: center;
      }

      .careers-nav2 {
        display: none;
      }
    }

    .job-benefits {
      width: 80%;
      margin: auto;
      margin-top: 20%;
      text-align: center;
    }

    .benefits {
      display: flex;
      flex-wrap: wrap;

    }

    .benefits>div {
      border: 2px solid #4a9e4a;
      border-radius: 5px;
      padding: 4%;
      min-height: 300px;
      margin: 3% auto;
      width: 35%;

    }

    @media only screen and (max-width:768px) {

      .benefits>div {
        width: 60%;
      }

    }

    }

    .benefits-title .title h3 {
      font-size: 20px;
      margin: 0;
      padding: 2% 4%;

    }

    .benefits-title .logo {
      font-size: 60px;


    }

    .benefits-detail {
      padding-top: 6%;
      font-size: 16px;
      text-align: justify;
    }
  </style>
@endsection
@section('content')
<!-- CAREERS -->
<section class="careers row">
    <div class='col-md-6 col-sm-12 careers-nav' style="padding-top: 15%;">
      <h2>Career at FreshKTM</h2>

      <p><b>Better Food Life For People</b></p>

      <br>
      <a class="btn btn-primary" href="#careers">Apply Now</a>

    </div>

    <div class='col-md-6 careers-nav careers-nav2'>
      <img
        src="https://media.istockphoto.com/vectors/happy-young-employees-giving-support-and-help-each-other-vector-id1218490893?b=1&k=6&m=1218490893&s=170667a&w=0&h=BaGXX08PIULu0HX_i63tumL5AzL62xpRSrN45rLFsHo="
        alt="">

    </div>

  </section>

  <section class="career-section" id="careers">

    <div class="career-page-description">
      <p>We believe that we can do more than your expectation in quality fresh produce supply in Nepal.


        We want to be a company where people are allowed to grow indicidually and as a team. Come and Join Us in our
        mission of making <b>Fetter food life for people</b>.

        <br><br>
        <b>FreshKTM</b> is currently seeking qualified cadidates for following positions :



      </p>
    </div>

    <div class="career-opening col-md-12">
      <div class="panel-group col-md-6 col-sm-10" id="accordion" role="tablist" aria-multiselectable="true">
        @if(isset($careers))
        @foreach($careers as $career)
        <!-- JOB ONE -->
        <div class="panel panel-default">
          <div class="panel-heading job-title" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                {{$career->job_title}}
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse job-description" role="tabpanel"
            aria-labelledby="headingOne">
            <div class="panel-body job-detail">
              {!! $career->job_description!!}
              <br>
            <a href="{{$career->form_link}}" target="_blank" class="btn btn-primary job-apply">Apply Now</a>
          </div>
        </div>
        @endforeach
        @endif

      </div>
    </div>
    <br> <br><br>
    <div class="col-md-10 col-sm-12">
      <p>Find your new challenge from the career path mention above. For any queries mail us at <a
          href="mailto:info@freshktm.com">info@freshktm.com</a></p>
    </div>
  </section>



  <!-- JOB BENEFITS -->

  <section class="job-benefits">
    <div class="section-title">
      <h2>Grow With Us</h2>
      <div class="title-border"></div>
      <p>We belive in You</p>
    </div>

    <div class="row benefits">
      <!-- Benefit 1 -->
      <div class="">
        <div class="benefits-title row">
          <div class="col-md-8 title">
            <h3>Learning & Development</h3>
          </div>
          <div class="col-md-4 logo"> <i class="fa fa-cogs" aria-hidden="true"></i></div>
        </div>
        <div class="benefits-detail">
          We offer Great training and support endless growth opportunity for the people who work with us.
        </div>

      </div>

      <!-- BENEFIT 2 -->
      <div class="">
        <div class="benefits-title row">
          <div class="col-md-8 title">
            <h3>Employee Discount</h3>
          </div>
          <div class="col-md-4 logo"><i class="fa fa-percent" aria-hidden="true"></i></div>
        </div>
        <div class="benefits-detail">
          We offer employee discount so that you can save on your daily food expenses.
        </div>

      </div>

      <!-- BENEFIT 2 -->
      <div class="">
        <div class="benefits-title row">
          <div class="col-md-8 title">
            <h3>Recreational Activities</h3>
          </div>
          <div class="col-md-4 logo"><i class="fa fa-user-secret" aria-hidden="true"></i></div>
        </div>
        <div class="benefits-detail">
          We encourage more sports, gathering and other social recreational activities to promote team work and mental
          well being among employees.
        </div>

      </div>

      <!-- BENEFIT 2 -->
      <div class="">
        <div class="benefits-title row">
          <div class="col-md-8 title">
            <h3>Friendly Enviroment</h3>
          </div>
          <div class="col-md-4 logo"><i class="fa fa-users" aria-hidden="true"></i></div>
        </div>
        <div class="benefits-detail">
          You will get to work in an inclusive enviroment and make difference in our community we serve.
        </div>

      </div>

    </div>

  </section>
@endsection