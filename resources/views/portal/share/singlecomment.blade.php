
<div class="comment mt-2 text-justify col-12">
    <h4>@if(!empty($comment->user->name)) {{ $comment->user->name }} @else {{ $comment->name ?? 'anonymous' }} @endif</h4>
    <span>- {{ $comment->created_at->diffForHumans() }}</span> <br>
    <p>{{ $comment->comment }}</p>
    <p class=" float-left" id="addreply" data-id="{{ $comment->id }}"><i class="fad fa-reply"></i></p>
</div>


@include('portal.share.replies', ['replies' => $comment->replies])

