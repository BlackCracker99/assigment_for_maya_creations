<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>::Location Finder ::</title>
</head>

<body>
    <div class="container">
        <div class="card bg-dark mt-3">
            <h5 class="card-header">

                <!-- nav bar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/">Location Finder</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" style="padding-left: 15rem;" id="navbarSupportedContent">

                            <form class="d-flex" name="send-search" id="send-search" method="get" action="{{route('search_location')}}">
                                <input class="form-control me-2" name="query" type="search" placeholder="Search Places" aria-label="Search">
                                <button class="btn btn-primary btn-sm" type="submit">Search</button>
                            </form>
                        </div>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if (Route::has('login'))
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            @endif
                            @endauth
                            @endif
                        </ul>
                    </div>
                </nav>
            </h5>

            <!-- image galary -->
            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                @if(session('status_failed'))
                <div class="alert alert-danger">
                    {{ session('status_failed') }}
                </div>
                @endif

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($locations as $location)
                    <div class="col">
                        <div class="card">
                            <img src="{{ url('public/Image/'.$location->image) }}" class="card-img-top" alt="..." style="width: 100%; height : 18rem;">
                            <div class="card-body bg-dark">
                                <h5 class="card-title" style="color: white;">{{$location->title}}</h5>
                                <p class="card-text" style="color: white;">{{$location ->description}}</p>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalSendInquary_{{$location->title}}">Send Inquary</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- <div class="col">
                        <div class="card">
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/12/fd/fb/66/sigiriya-sri-lanka.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-dark">
                                <h5 class="card-title" style="color: white;">Card title</h5>
                                <p class="card-text" style="color: white;">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <button type="button" class="btn btn-primary btn-sm">Send Inquary</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/12/fd/fb/66/sigiriya-sri-lanka.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-dark">
                                <h5 class="card-title" style="color: white;">Card title</h5>
                                <p class="card-text" style="color: white;">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                                <button type="button" class="btn btn-primary btn-sm">Send Inquary</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/12/fd/fb/66/sigiriya-sri-lanka.jpg" class="card-img-top" alt="...">
                            <div class="card-body bg-dark">
                                <h5 class="card-title" style="color: white;">Card title</h5>
                                <p class="card-text" style="color: white;">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <button type="button" class="btn btn-primary btn-sm">Send Inquary</button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        @foreach($locations as $location)
        <!-- Modal -->
        <div class="modal fade" id="modalSendInquary_{{$location->title}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Send Your inquary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark">
                        <form name="send-inquary" id="send-inquary" method="post" action="{{url('send-inquary')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="color: white;">Name</label>
                                <input type="text" class="form-control bg-secondary" name="name" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="color: white;">Email address</label>
                                <input type="email" class="form-control bg-secondary" name="email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="color: white;">Location</label>
                                <input type="text" class="form-control bg-secondary" name="location" value="{{$location->title}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="color: white;">Mobile Number</label>
                                <input type="text" class="form-control bg-secondary" name="mobile">

                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else and will contact you soon..!</div>
                            </div>

                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>