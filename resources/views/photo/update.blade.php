@extends('app.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/photo.css') }}">
@endsection

@section('content')
    <!-- Team -->
    <section id="team" class="pb-5">
        <div class="container">
            <div class="row m-0 justify-content-between align-items-center">
                <h5 class="section-title h1">Update Photo</h5>
            </div>
            @include('photo.form')
        </div>
    </section>
@endsection
