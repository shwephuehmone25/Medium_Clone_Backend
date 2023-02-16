<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.common')
    <div class="loader-container">
        <div class="spinner"></div>
    </div>
    <div class="w-100 d-flex justify-content-center py-4">
        @foreach ($posts as $post)
            <div class="container-wrapper m-sm-2">
                <div class="w-80 w-sm-100 mx-auto d-flex flex-wrap col-12 border-1 border-bottom">
                    <div class="col-lg-8 order-lg-1 col-sm-12 order-2 d-flex flex-column border-1 border-end pe-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="pf-img">
                                    <img src="{{ asset('storage/images/' . $post->user->image) }}" alt=""
                                        width="100%"
                                        onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('profile') }}">
                                        <h5 class="writer text-capitalize">{{ $post->user->name }}</h5>
                                    </a>
                                    <span
                                        class="text-muted text-sm">{{ $post->created_at->toFormattedDateString() }}·</span>
                                    <span class="text-muted text-sm">{{ $post->created_at->diffForHumans() }}·</span>
                                </div>
                            </div>
                            <div class="mx-2">
                                <button class="px-2 py-1 rounded-pill bg-secondary mx-3 text-light border-0 text-sm">
                                    <a href="{{ route('lists') }}">
                                        <i class="fa-solid fa-arrow-left-long"></i>
                                        {{__('Back')}}
                                    </a>
                                </button>
                                @can('manage_users', $post)
                                    <button class="px-2 py-1 rounded-pill bg-danger mx-3 text-light border-0 text-sm">
                                        <i class="fa-solid fa-trash"></i>
                                        {{__('Delete')}}
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="w-100 overflow-hidden my-3">
                                <img src="{{ asset('storage/images/' . $post->image) }}" alt="" width="100%"
                                    onerror="this.onerror=null;this.src='{{ asset('img/default.jpg') }}';" />
                            </div>
                            <h3 class="my-3 text-capitalize">{{ $post->title }}</h3>
                            <p class="my-3 text-justify">{!! $post->description !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-2 col-sm-12 order-1 border-left border-1 ps-3">
                        <div class="w-100 mx-auto">
                            <div class="d-flex flex-column">
                                <div class="row my-3">
                                    <div class="col-md-12 d-flex">
                                        <img src="{{ asset('storage/images/' . $post->user->image) }}" alt="Profile"
                                            height="40px" width="40px" class="pf-img"
                                            onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                        <a href="{{ route('profile') }}">
                                            <h6 class="px-2 text-capitalize">
                                                {{ $post->user->name }}
                                                <br />
                                                <p class="text-secondary">{{ $post->count() }} {{__('posts')}}</p>
                                            </h6>
                                        </a>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="txt">Advocate/poet. Over 30 yrs. of leadership of multiple DEI
                                            causes. Sparking insights of the race & gender nexus with
                                            history, philosophy, advancing human life.</span>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <h5>{{__('More from Medium')}}</h5>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12 d-flex">
                                        <img src="{{ asset('storage/images/' . $post->user->image) }}" alt=""
                                            class="pf-img" width="100%"
                                            onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                        <a href="{{ route('profile') }}">
                                            <span
                                                class="px-2 text-muted text-capitalize">{{ $post->user->name }}</span>
                                        </a>
                                    </div>
                                    @foreach ($posts as $post)
                                        <div class="col-8 mt-3">
                                            <a href="{{ route('post.show', $post->id) }}">
                                                <span class="fw-semibold text-capitalize">{{ $post->title }}
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-4 mt-3">
                                            <img src="{{ asset('storage/images/' . $post->image) }}" height="40px"
                                                width="40px"
                                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-80 mx-auto py-3">
                    <h5 class="cmt">
                        {{__('Comment')}}
                        <span class="cmt-count fw-bold bg-secondary text-white">{{ $post->comments->count() }}</span>
                    </h5>
                    <div class="card-body">
                        <h5 class="fs-6">{{__('Here you can left message !')}}</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <div class="form-group">
                                    <textarea type="text" name="body" class="form-control"></textarea>
                                    @error('body')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                </div>
                                <div class="d-flex align-items-center justify-content-end my-2">
                                    <input type="submit" class="p-1 bg-secondary text-light border-0 rounded"
                                        style="font-size: 0.8em;" value="{{__('Comment')}}" />
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('comment.replies', ['comments' => $post->comments, 'post_id' => $post->id])
                </div>
            </div>
    </div>
    @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        const loaderContainer = document.querySelector('.loader-container');
        window.addEventListener('load', () => {
            loaderContainer.classList.add('loader-container-hidden');
            const displayLoading = () => {
                loaderContainer.style.display = 'block';

                const hideLoading = () => {
                    loaderContainer.style.display = 'none';
                };
            };
        });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
