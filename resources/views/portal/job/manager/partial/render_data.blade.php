@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize">{{ $list->title }}</td>
    <td class="text-capitalize limittablechar">{{ $list->full_description ?? '--' }}</td>
    <td class="text-capitalize"> </td>
    <td class="text-capitalize"> 12 </td>
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
    <td>
        @can('manage_job')
            <a href="{{$list->slugurl}}" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.view')"> <i class="fad fa-eye"></i></a>
        @endcan

        @can('update_job')
            <a href="{{route('edit_job',  $list->slug)}}" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>
        @endcan

        @can('delete_job')
            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>
        @endcan
    </td>



</tr>

@endforeach

