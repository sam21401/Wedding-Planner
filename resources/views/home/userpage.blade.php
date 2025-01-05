@extends('home.app')

@section('title', 'Planner ślubu - Twój niezawodny pomocnik')

@section('content')
<div class="hero_area">
    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->
</div>




    <!-- new arrival section -->
    @include('home.new_arrival')
    <!-- end new arrival section -->

 

    <!-- subscribe section 
    @include('home.subscribe')
    end subscribe section -->

    <!-- client section
    @include('home.client')
    end client section -->
@endsection
