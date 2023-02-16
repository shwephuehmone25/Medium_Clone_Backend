@include('layouts.common')
@include('common.alert')
@auth
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-8">
                @if (request('search'))
                    <h5 class="searchPost mb-3 mt-3">
                        {{__('Search Results for')}} {{ request('search') }}...
                    </h5>
                    <hr />
                @endif
                @forelse ($posts as $post)
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="d-flex justify-content-start">
                                <div class="px-2" style="width: 100%" id="pf-img">
                                    <a href="{{ route('profile') }}">
                                        <p class="mb-2 pst-wrt">
                                            <img src="{{ asset('storage/images/' . $post->user->image) }}" alt="default"
                                                width="24px" name="image" height="24px" class="rounded-circle"
                                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                            <span class="text-capitalize">{{ $post->user->name }}</span>
                                            <span class="text-muted pst-date">.
                                                {{ __($post->created_at->toFormattedDateString()) }}
                                            </span>
                                        </p>
                                    </a>
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h6 class="list-ttl text-capitalize">
                                            {{ $post->title }}
                                        </h6>
                                    </a>
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <p class="list-txt">
                                            {!! $post->description !!}
                                        </p>
                                    </a>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-3">
                                                    @foreach ($post->categories as $c)
                                                        <a href="{{ route('category.show', $c->id) }}">
                                                            <button
                                                                class="btn cat-txt cat btn-sm text-dark rounded-pill mt-1"
                                                                id="catBtn" onclick="myFunction()">
                                                                {{ $c->name }}
                                                            </button>
                                                        </a>
                                                    @endforeach
                                                </div>

                                                <div class="col-3">
                                                    <p class="blog-date">{{ __($post->created_at->diffForHumans()) }} </p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="blog-date fw-bold">{{ __('Selected for you.') }}</p>
                                                </div>
                                                <div class="col-3 d-flex">
                                                    @can('like', $post)
                                                        <form action="{{ route('post.like') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="likeable_type"
                                                                value="{{ get_class($post) }}" />
                                                            <input type="hidden" name="id" value="{{ $post->id }}" />
                                                            <button class="btn btn-sm btn-primary">
                                                                <i class="fa-solid fa-thumbs-up"></i>
                                                            </button>
                                                        </form>
                                                    @endcan

                                                    @can('unlike', $post)
                                                        <form action="{{ route('post.unlike') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="likeable_type"
                                                                value="{{ get_class($post) }}" />
                                                            <input type="hidden" name="id" value="{{ $post->id }}" />
                                                            <button class="btn btn-sm btn-danger">
                                                                <i class="fa-solid fa-thumbs-down"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                    {{ trans_choice('{0} no like|{1} :count like|[2,*] :count likes', count($post->likes), ['count' => count($post->likes)]) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            @can('manage_users', $post)
                                                <div class="dropdown">
                                                    <button class="btn btn-white p-0 border-0" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" class="list-btn"
                                                            fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M4.39 12c0 .55.2 1.02.59 1.41.39.4.86.59 1.4.59.56 0 1.03-.2 1.42-.59.4-.39.59-.86.59-1.41 0-.55-.2-1.02-.6-1.41A1.93 1.93 0 0 0 6.4 10c-.55 0-1.02.2-1.41.59-.4.39-.6.86-.6 1.41zM10 12c0 .55.2 1.02.58 1.41.4.4.87.59 1.42.59.54 0 1.02-.2 1.4-.59.4-.39.6-.86.6-1.41 0-.55-.2-1.02-.6-1.41a1.93 1.93 0 0 0-1.4-.59c-.55 0-1.04.2-1.42.59-.4.39-.58.86-.58 1.41zm5.6 0c0 .55.2 1.02.57 1.41.4.4.88.59 1.43.59.57 0 1.04-.2 1.43-.59.39-.39.57-.86.57-1.41 0-.55-.2-1.02-.57-1.41A1.93 1.93 0 0 0 17.6 10c-.55 0-1.04.2-1.43.59-.38.39-.57.86-.57 1.41z"
                                                                fill="#000"></path>
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('post.edit', $post->id) }}"
                                                                class="dropdown-item text-decoration-none text-success">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                               {{__('Edit')}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('post.destroy', $post->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('{{ trans('Are You Sure ? ') }}');"
                                                                style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <button type="submit"
                                                                    class="delete-btn btn btn-sm text-danger"
                                                                    value="Delete"><i class="fa-solid fa-trash"></i>
                                                                    {{__('Delete')}}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('storage/images/' . $post->image) }}" class="img"
                                onerror="this.onerror=null;this.src='{{ asset('img/default.jpg') }}';" />
                        </div>
                    </div>
                    <hr />
                @empty
                    <h5 class="text-danger text-center mt-5 mb-3">{{__('No Posts here')}}!!!</h5>
                    <img src="{{ asset('img/no-data.png') }}" height="50%" width="50%"
                        class="noPost align-item-center" />
                @endforelse
            </div>

            <div class="col-4 mt-5">
                <h5 class="aside-ttl">{{ __('2023 in Latest Posts') }}</h5>
                @foreach ($latest as $latestPost)
                    <div class="row mb-3">
                        <div class="d-flex">
                            <img src="{{ asset('storage/images/' . $latestPost->user->image) }}" alt="default"
                                name="image" height="100%" class="pf-img"
                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                            <a href="{{ route('profile') }}">
                                <p class="text-muted text-capitalize px-2">{{ $latestPost->user->name }}</p>
                            </a>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="{{ route('post.show', $latestPost->id) }}">
                                    <h6 class="fw-semibold text-capitalize">{{ $latestPost->title }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr />
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->id) }}"
                        class="aside-txt border me-2 mb-2 rounded d-inline-block px-2 py-2 text-decoration-none text-secondary"
                        value="{{ $category['id'] }}">{{ $category['name'] }}</a>
                @endforeach
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endauth
@guest
    <div class="container-fluid bg-warning border-bottom border-dark">
        <div class="container banner">
            <h2 class="banner-title">Stay curious.</h2>
            <h3 class="blog-content lh-sm w-50">
                Discover stories, thinking, and expertise<br />
                from writers on any topic.
            </h3>
            <button class="banner-btn btn rounded-pill bg-dark text-white btn-text mb-2">
                {{ __('Start reading') }}
            </button>
        </div>
    </div>

    <div class="container mt-3">
        <div class="float-start">
            <div class="float-lg-end float-sm-none col-md-4 col-sm">
                <div class="col-md-12 mt-3" style="z-index: 1">
                    <h6 class="aside-ttl">DISCOVER MORE OF WHAT MATTER TO YOU</h6>
                    @foreach ($categories as $category)
                        <a href=""
                            class="aside-txt border me-2 mb-2 rounded d-inline-block px-2 py-2 text-decoration-none text-secondary"
                            value="{{ $category['id'] }}">{{ $category['name'] }}
                        </a>
                    @endforeach
                    <hr />
                    <a href="" class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Help</a>
                    <a href=""
                        class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Status</a>
                    <a href=""
                        class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Writers</a>
                    <a href="" class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Blog</a>
                    <a href=""
                        class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Careers</a>
                    <a href=""
                        class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Privacy</a>
                    <a href="" class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Terms</a>
                    <a href="" class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">About</a>
                    <a href="" class="me-2 mb-2 d-inline-block px-2 py-2 text-decoration-none aside-text">Text to
                        speech</a>
                </div>
            </div>
            <div class="float-lg-start float-sm-none col-md-6 col-sm mt-3">
                @foreach ($posts as $post)
                    <div class="row">
                        <div class="col-8 mt-3">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('storage/images/' . $post->user->image) }}" class="rounded-circle"
                                    alt="Cinque Terre" width="20px" height="20px"
                                    onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                <div class="px-2">
                                    <h4 class="author">
                                        {{ $post->user->name }}
                                    </h4>
                                    <h6 class="content-ttl mb-2 mt-2 text-capitalize">
                                        {{ $post->title }}
                                    </h6>
                                    <p class="content mb-2">{!! $post->description !!}</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="blog-date">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="col-6">
                                            @foreach ($post->categories as $c)
                                                <a href="{{ route('category.show', $c->id) }}">
                                                    <button class="btn cat-txt cat btn-sm text-dark rounded-pill mt-1"
                                                        id="catBtn">
                                                        {{ $c->name }}
                                                    </button>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-3">
                            <img src="{{ asset('storage/images/' . $post->image) }}" class="img"
                                onerror="this.onerror=null;this.src='{{ asset('img/default.jpg') }}';" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endguest
