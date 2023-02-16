<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post Lists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.common')
    <div class="container">
        <div class="row">
            <div class="col-8">
                @if (request('search'))
                    <h5 class="searchPost mb-3">
                        Search Results for {{ request('search') }}...
                    </h5>
                @endif
                @if (request('id', 'category_id'))
                        <h2 class="mt-3">
                            <svg width="21" height="21" class="ux">
                                <path
                                    d="M4.66 8.72L3.43 9.95a1.75 1.75 0 0 0 0 2.48l5.14 5.13c.7.7 1.8.69 2.48 0l1.23-1.22 5.35-5.35a2 2 0 0 0 .51-1.36l-.32-4.29a2.42 2.42 0 0 0-2.15-2.14l-4.3-.33c-.43-.03-1.05.2-1.36.51l-.79.8-2.27 2.28-2.28 2.27zm9.83-.98a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5z"
                                    fill-rule="evenodd"></path>
                            </svg>
                            {{ $posts[0]?->categories[0]?->name }}
                        </h2>
                        <hr/>
                    @endif
                @forelse ($posts as $post)
                    <div class="row mt-5">
                        <div class="col-8">
                            <div class="d-flex justify-content-start">
                                <div class="px-2" style="width: 100%" id="pf-img">
                                    <a href="{{ route('profile') }}">
                                        <p class="mb-2 pst-wrt">
                                            <img src="{{ asset('storage/images/' . $post->user->image) }}"
                                                alt="default" width="24px" name="image" height="24px"
                                                class="rounded-circle"
                                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                            {{ $post->user->name }}
                                            <span class="text-muted pst-date">.
                                                {{ $post->created_at->toFormattedDateString() }}</span>
                                        </p>
                                    </a>
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h6 class="list-ttl">
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
                                                <div class="col-4">
                                                    @foreach ($post->categories as $c)
                                                        <a href="{{ route('category.show', $c->id) }}">
                                                            <button
                                                                class="btn cat-txt cat btn-sm text-dark rounded-pill mt-1"
                                                                id="catBtn" onclick="categoryBtn"
                                                                data-toggle="collapse" class="">
                                                                {{ $c->name }}
                                                            </button>
                                                        </a>
                                                    @endforeach
                                                </div>

                                                <div class="col-4">
                                                    <p class="blog-date">{{ $post->created_at->diffForHumans() }} </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="blog-date">Selected for you·</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown">
                                                <button class="btn btn-white p-0 border-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        class="list-btn" fill="none">
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
                                                            Edit
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
                                                                value="Delete"><i class="fa-solid fa-trash"></i>Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('storage/images/' . $post->image) }}" height="112" width="112"
                                enctype="multipart/form-data" onerror="this.onerror=null;this.src='{{ asset('img/default.jpg') }}';"  />
                        </div>
                    </div>
                    <hr />
                @empty
                    <h5 class="text-danger text-center mt-5">No Posts here!!!</h5>
                    <img src="{{ asset('img/no-data.png') }}" height="50%" width="50%"
                        class="noPost align-item-center" />
                @endforelse
            </div>

            <div class="col-4 mt-5">
                <h5 class="aside-ttl">2023 in Latest Posts</h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
