@foreach ($comments as $comment)
    <div class="display-comment" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="my-2">
            <div class="w-100 my-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="pf-img">
                            <img src="{{ asset('storage/images/' . $comment->user->image) }}" alt="default" name="image"
                                onerror="this.onerror=null;this.src='{{ asset('img/avatar.jpg') }}';" />
                        </div>
                        <div class="mx-2">
                            <h4>{{ $comment->user->name }}</h4>
                            <span class="text-sm text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <p class="cmt-blk fw-semibold">
                    {{ $comment->body }}
                </p>
            </div>
        </div>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('reply.add') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="row" style="margin-left: 80%;">
                <div class="col-3 mt-2">
                    <button type="submit" class="btn btn-sm py-1 px-2 btn-secondary">Reply</button>
                </div>
                @can('manage_comments', $comment)
                <div class="col-8">
                    <div class="row">
                        <form action="">
                            <div class="col-3 mt-2">
                                <button type="submit" class="btn btn-sm py-1 px-2 btn-warning"
                                    style="font-size: 0.8em;"  onclick="Edit()">Edit</button>
                            </div>
                        </form>
                        <div class="col-3">
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group mt-2" style="margin-left: 80%;">
                                    <button type="submit" class="btn btn-sm py-1 px-2 btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <form method="post" action="" id="cmtEdit-1" style="display: none;">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post_id }}" />
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        </div>
                        <div class="d-flex align-items-center justify-content-end my-2">
                            <button type="submit" class="btn btn-sm py-1 px-2 btn-secondary">Update</button>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </form>
        @include('comment.replies', ['comments' => $comment->replies])
    </div>
@endforeach

<script>
  function Edit() {
  var x = document.getElementById("cmtEdit");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}  
</script>
