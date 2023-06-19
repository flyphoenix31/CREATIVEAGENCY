@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{$list->created_at->diffForHumans()}}</td>
    <td class="text-capitalize">{{$list->type}}</td>
    <td class="text-capitalize">{{$list->user->name ?? ''}}</td>
    <td class="text-capitalize">{{$list->link}}</td>
    <td class="text-capitalize">{!! $list->expiredbadge !!}</td>
    <td class="text-capitalize">{!! $list->protectedbadge !!}</td>

</tr>

@endforeach

