@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize">{{ $list->title }}</td>
    <td class="text-capitalize limittablechar">{{ $list->full_description ?? '--' }}</td>
    <td class="text-capitalize"> </td>
    <td class="text-capitalize"> {{$list->budget}} </td>
    <td class="text-capitalize">
        @if($list->status_id == 1 )
            <label class='badge badge-success'>Active</label>
        @elseif($list->status_id == 2 )
            <label class='badge badge-dark'>Inactive</label>
        @elseif($list->status_id == 3 )
            <label class='badge badge-warning'>Closed</label>
        @elseif($list->status_id == 4 )
            <label class='badge badge-danger'>Suspended</label>
        @else
            <label class='badge badge-dark'>Deleted</label>
        @endif
    </td>


</tr>

@endforeach

