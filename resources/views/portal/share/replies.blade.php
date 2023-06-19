@foreach($replies as $reply)
    <div class="text-justify darker mt-4 float-right ml-5 col-11">
        <h4>@if(!empty($reply->user->name)) {{ $reply->user->name }} @else {{ $reply->name ?? 'anonymous' }} @endif</h4>
        <span>- {{ $reply->created_at->diffForHumans() }}</span> <br>
        <p>{{ $reply->comment }}</p>
    </div>
@endforeach
