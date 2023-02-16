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
    @include('layouts.common')
    @include('common.alert')
    <div class="container profile-blk">
        <div class="row">
            <div class="col-4 mt-5">
                <div class="d-flex justify-content-start">
                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="default" width="70"
                        name="image" height="70" class="rounded-circle"
                        onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                    <div class="px-2">
                        <h2 class="fw-bold name text-capitalize">{{ Auth::user()->name }}</h2>
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
                <!-- Button trigger modal -->
                <button type="button" class="editPf btn btn-sm btn-secondary rounded-pill modal-btn edit-txt">
                    {{__('Edit Profile')}}
                </button>
                <button type="button" id="btn" class="btn btn-sm btn-primary rounded-pill modal-btn edit-txt"
                    data-bs-toggle="modal" data-bs-target="#passwordModal">
                    {{__('Change Password')}}
                </button>
                <!-- Edit Modal -->
                <div class="modal fade show" id="editProfile" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">
                                   {{__('Profile Information')}}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="col-8">
                                        <form method="POST" action="{{ route('user.update', Auth::user()->id) }}"
                                            enctype="multipart/form-data" id="editForm">
                                            @csrf
                                            <input type="file" id="profile" name="image"
                                                class="rounded form-control" placeholder="Image" hidden />
                                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                                alt="Photo" width="70" height="70" class="rounded-circle"
                                                id="preview-image" name="image"
                                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                            @error('image')
                                                <small class="error-message text-danger">*{{ $message }}</small>
                                            @enderror
                                            <button type="button" class="btn text-success rounded-pill"
                                                id="update-btn">
                                                <i class="fa-solid fa-pen-to-square"></i> {{__('Update')}}
                                            </button>
                                            <button class="btn text-danger rounded-pill">
                                                <i class="fa-solid fa-trash"></i>{{__('Remove')}}
                                            </button>
                                            <div class="mb-3 mt-3">
                                                <label for="name" class="form-label">{{__('Name')}}*</label>
                                                <input type="text" class="form-control inp" id="name"
                                                    name="name" placeholder=""
                                                    value="{{ old('name', Auth::user()->name) }}" />
                                                @error('name')
                                                    <small class="error-message text-danger"
                                                        id="error-message">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">{{__('Bio')}}</label>
                                                <input type="text" class="form-control inp" id="bio"
                                                    placeholder="" name="bio"
                                                    value="{{ old('bio', Auth::user()->bio) }}" />
                                                @error('bio')
                                                    <small class="error-message text-danger"
                                                        id="error-message">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-outline-success rounded-pill"
                                    onclick="resetForm()" data-bs-dismiss="modal">
                                    {{__('Cancel')}}
                                </button>
                                <button type="submit"
                                    class="saveBtn btn btn-outline-success rounded-pill bg-success text-white"
                                    id="saveBtn">
                                    {{__('Save')}}
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password Modal -->
                <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="passwordModalLabel">
                                    {{__('Change Password')}}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="col-8">
                                        <form action="{{ route('password.update', Auth::user()->id) }}"
                                            method="POST" id="profileForm">
                                            @csrf
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <div class="mb-3 mt-3">
                                                <label for="oldPassword" class="form-label">{{__('Old Password')}}</label>
                                                <input type="text" name="old_password" class="form-control inp"
                                                    id="oldPassword" placeholder="Old Password" />
                                                @error('old_password')
                                                    <small class="error-message text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">{{__('New Password')}}</label>
                                                <input type="password" name="new_password" class="form-control inp"
                                                    id="newPassword" placeholder="New Password" />
                                                @error('new_password')
                                                    <small class="error-message text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm
                                                    Password</label>
                                                <input name="new_password_confirmation" type="password"
                                                    class="form-control inp" id="confirmPassword"
                                                    placeholder="Confirm Password" />
                                                @error('new_password_confirmation')
                                                    <small class="error-message text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-outline-success rounded-pill"
                                                    data-bs-dismiss="modal" onclick="resetForm()">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="saveBtn btn btn-outline-success rounded-pill bg-success text-white">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-5 info-ttl">{{__('Information')}}</h2>
        <hr />
        <div class="row">
            <div class="col-12 mt-3">
                <h6 class="pst-ttl2">{{ __('Email') }}</h6>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <h6 class="pst-ttl2">{{__('Post Count')}}</h6>
                <button class="btn btn-sm pst-count rounded-pill bg-secondary text-white">
                    {{ $posts->count() }}
                </button>
                <h6 class="mt-3 pst-ttl2">{{__('Bio')}}</h6>
                <p class="my-3 text-muted text-justify p-txt">
                    {{ Auth::user()->bio }}
                </p>
                <h6 class="mypst-ttl">{{__('My Posts')}}</h6>
                <hr />
                @foreach ($posts as $post)
                    <div class="row">
                        <div class="col-4 mt-3">
                            <div class="d-flex justify-content-start">
                                <div class="px-2" style="width:100%;">
                                    <h4 class="author text-muted">
                                        <img src="{{ asset('storage/images/' . $post->user->image) }}" alt="default"
                                            width="20px" name="image" height="20px" class="rounded-circle"
                                            onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                                        {{ $post->user->name }}
                                        <span class="blog-date">{{ $post->created_at->diffForHumans() }} </span>
                                    </h4>
                                    <h6 class="mypst-ttl mb-2 mt-2">
                                        {{ $post->title }}
                                    </h6>
                                    <p class="content mb-2 justify-text">
                                        {!! $post->description !!}
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach ($post->categories as $c)
                                                <button class="btn cat-txt cat btn-sm text-dark rounded-pill">
                                                    {{ $c->name }}
                                                </button>
                                            @endforeach
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('post.show', $post->id) }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.39 12c0 .55.2 1.02.59 1.41.39.4.86.59 1.4.59.56 0 1.03-.2 1.42-.59.4-.39.59-.86.59-1.41 0-.55-.2-1.02-.6-1.41A1.93 1.93 0 0 0 6.4 10c-.55 0-1.02.2-1.41.59-.4.39-.6.86-.6 1.41zM10 12c0 .55.2 1.02.58 1.41.4.4.87.59 1.42.59.54 0 1.02-.2 1.4-.59.4-.39.6-.86.6-1.41 0-.55-.2-1.02-.6-1.41a1.93 1.93 0 0 0-1.4-.59c-.55 0-1.04.2-1.42.59-.4.39-.58.86-.58 1.41zm5.6 0c0 .55.2 1.02.57 1.41.4.4.88.59 1.43.59.57 0 1.04-.2 1.43-.59.39-.39.57-.86.57-1.41 0-.55-.2-1.02-.57-1.41A1.93 1.93 0 0 0 17.6 10c-.55 0-1.04.2-1.43.59-.38.39-.57.86-.57 1.41z"
                                                        fill="#000"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-3">
                            <img src="{{ asset('storage/images/' . $post->image) }}" class="img" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            @if (Session::has('errors'))
                $("#editProfile").modal('show');
            @endif

            $("#update-btn").click(function() {
                $("#profile").click();
            });
            $(".editPf").click(function() {
                 $("#editProfile").modal('show');
            })
        });

        $(document).ready(function() {
            $("#saveBtn").click(function() {
                $("#error-message").show();
            });
        });

        $(document).ready(function(e) {
            $('#profile').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

            });
        });

        function resetForm() {
            $("#addForm input[type='text'],input[type='password']").each(function() {
                $(this).removeClass('error-message');
                $(this).addClass("form-control");
            });
            $(".error-message").text('');
        }
    </script>

</body>

</html>
