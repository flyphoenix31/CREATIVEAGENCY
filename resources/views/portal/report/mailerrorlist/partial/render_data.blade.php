@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{$list->created_at}}</td>
    <td class="text-capitalize">{{$list->type}}</td>
    <td class="text-capitalize">{{$list->user->name ?? ''}}</td>
    <td class="text-capitalize">{{$list->email}}</td>
    <td class="text-capitalize">{{$list->error_data}}</td>

</tr>

@endforeach

