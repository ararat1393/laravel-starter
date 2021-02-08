@extends('app.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/photo.css') }}">
@endsection

@section('content')
    <!-- Team -->
    <section id="team" class="pb-5">
        <div class="container">
            <div class="row m-0 justify-content-between align-items-center">
                <h5 class="section-title h1">User Photos</h5>
                <a href="{{ route('photo.create') }}" class="btn btn-success">Create Photo</a>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="row">
                <form class="col-12" method="GET">
                    <div class="input-group form-search">
                        <div class="form-outline">
                            <label class="w-100">
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search"
                                    value="{{ request()->search }}"
                                />
                            </label>
                        </div>
                        <input type="hidden" name="page" value="{{ request()->page }}">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Team member -->
                @foreach($photos as $photo)
                    <a href="{{ route('photo.edit',['photo' => $photo->id]) }}">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip" >
                                <div class="mainflip flip-0">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p><img class=" img-fluid" src="{{ $photo->link  }}" alt="card image"></p>
                                                <h4 class="card-title">{{ $photo->name }}</h4>
                                                <p class="card-text">{{ $photo->description  }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside">
                                        <div class="card">
                                            <div class="card-body text-center mt-4">
                                                <p><img class=" img-fluid" src="{{ $photo->user->profile_photo  }}" alt="card image"></p>
                                                <h4 class="card-title">{{ $photo->user->name  }}</h4>
                                                <p class="card-text">{{ $photo->user->email }}</p>
                                                <p class="card-text"><b>{{ $photo->user->id }}</b></p>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                            <i class="fa fa-skype"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <!-- ./Team member -->

                <!-- Pagination -->
                <div class="col-12 d-flex justify-content-center">
                    {{ $photos->onEachSide(3)->links('pagination.default') }}
                </div>
                <!-- Pagination -->
            </div>
        </div>
    </section>
@endsection
