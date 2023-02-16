<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header class="w-100 d-flex justify-content-center align-items-center border-bottom border-secondary">
        <div class="container-wrapper">
            <div class="w-100 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center py-3">
                    <a href="{{ route('lists') }}">
                        <svg viewBox="0 0 1043.63 592.71" height="25px">
                            <g data-name="Layer 2">
                                <g data-name="Layer 1">
                                    <path
                                        d="M588.67 296.36c0 163.67-131.78 296.35-294.33 296.35S0 460 0 296.36 131.78 0 294.34 0s294.33 132.69 294.33 296.36M911.56 296.36c0 154.06-65.89 279-147.17 279s-147.17-124.94-147.17-279 65.88-279 147.16-279 147.17 124.9 147.17 279M1043.63 296.36c0 138-23.17 249.94-51.76 249.94s-51.75-111.91-51.75-249.94 23.17-249.94 51.75-249.94 51.76 111.9 51.76 249.94">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </a>
                    <div class="mx-4 bg-slate-opt rounded-pill overflow-hidden d-flex align-items-center pr-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="searchsvg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.1 11.06a6.95 6.95 0 1 1 13.9 0 6.95 6.95 0 0 1-13.9 0zm6.94-8.05a8.05 8.05 0 1 0 5.13 14.26l3.75 3.75a.56.56 0 1 0 .8-.79l-3.74-3.73A8.05 8.05 0 0 0 11.04 3v.01z"
                                fill="currentColor"></path>
                        </svg>
                        <form action="{{ route('lists') }}" method="GET" role="search">
                            <input type="text" name="search" class="w-100 border-0 py-2 px-3 bg-transparent search"
                                tabindex="0" placeholder="Search Medium" />
                        </form>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button class="d-flex mx-2 align-items-center justify-content-center border-0 bg-transparent">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-label="Write">
                            <path
                                d="M14 4a.5.5 0 0 0 0-1v1zm7 6a.5.5 0 0 0-1 0h1zm-7-7H4v1h10V3zM3 4v16h1V4H3zm1 17h16v-1H4v1zm17-1V10h-1v10h1zm-1 1a1 1 0 0 0 1-1h-1v1zM3 20a1 1 0 0 0 1 1v-1H3zM4 3a1 1 0 0 0-1 1h1V3z"
                                fill="currentColor"></path>
                            <path
                                d="M17.5 4.5l-8.46 8.46a.25.25 0 0 0-.06.1l-.82 2.47c-.07.2.12.38.31.31l2.47-.82a.25.25 0 0 0 .1-.06L19.5 6.5m-2-2l2.32-2.32c.1-.1.26-.1.36 0l1.64 1.64c.1.1.1.26 0 .36L19.5 6.5m-2-2l2 2"
                                stroke="currentColor"></path>
                        </svg>
                        <span class="px-1"> <a href="{{ route('post.create') }}"> Write</a></span>
                    </button>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="mx-2 overflow-hidden" style="width: 30px; height: 30px; border-radius: 50%">
                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="default"
                                width="32px" name="image" height="32px" class="rounded-circle"
                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                        </div>
                        <small>{{ Auth::user()->name }}</small>
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('lists') }}">Lists</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container profile-blk">
        <div class="row">
            <div class="col-4 mt-5">
                <div class="d-flex justify-content-start">
                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="default" width="70"
                        name="image" height="70" class="rounded-circle"
                        onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                    <div class="px-2">
                        <h2 class="fw-bold name">{{ Auth::user()->name }}</h2>
                    </div>
                    <hr />
                </div>
            </div>
            <div class="col-4 mt-5">
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="dot">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.39 12c0 .55.2 1.02.59 1.41.39.4.86.59 1.4.59.56 0 1.03-.2 1.42-.59.4-.39.59-.86.59-1.41 0-.55-.2-1.02-.6-1.41A1.93 1.93 0 0 0 6.4 10c-.55 0-1.02.2-1.41.59-.4.39-.6.86-.6 1.41zM10 12c0 .55.2 1.02.58 1.41.4.4.87.59 1.42.59.54 0 1.02-.2 1.4-.59.4-.39.6-.86.6-1.41 0-.55-.2-1.02-.6-1.41a1.93 1.93 0 0 0-1.4-.59c-.55 0-1.04.2-1.42.59-.4.39-.58.86-.58 1.41zm5.6 0c0 .55.2 1.02.57 1.41.4.4.88.59 1.43.59.57 0 1.04-.2 1.43-.59.39-.39.57-.86.57-1.41 0-.55-.2-1.02-.57-1.41A1.93 1.93 0 0 0 17.6 10c-.55 0-1.04.2-1.43.59-.38.39-.57.86-.57 1.41z"
                            fill="#000"></path>
                    </svg>
                </a>
            </div>
        </div>
        <h2 class="mt-5 info-ttl">Information</h2>
        <hr />
        <div class="row">
            <div class="col-12 mt-3">
                <h6 class="pst-ttl2">Email</h6>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <h6 class="pst-ttl2">Post Count</h6>
                <button class="btn btn-sm pst-count rounded-pill bg-secondary text-white">
                    {{ $posts->count() }}
                </button>
                <h6 class="mt-3 pst-ttl2">Bio</h6>
                <p class="my-3 text-muted text-justify p-txt">
                    {{ Auth::user()->bio }}
                </p>
                <hr />    
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
</body>

</html>
