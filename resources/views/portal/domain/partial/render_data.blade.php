@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>

    <td class="text-capitalize"> {{ $list->name }}</td>
    <td class="text-capitalize"> {{ $list->hosting_provider_name ?? '--' }}</td>
    <td class="text-capitalize ">{{ $list->customer_name ?? '--' }}</td>

    <td class="text-capitalize">{{ $list->reg_at->format('M d Y') }}</td>
    <td class="text-capitalize">
        @if($list->status == 'expiring')
            <span class="text-danger">{{ $list->expire_at->diffForHumans() }}</span>
        @else
            {{ $list->expire_at->format('M d Y') }}
        @endif

    </td>

    <td class="text-capitalize limittablechar">
        @if($list->is_autorenew == 1 )
            <label class='badge badge-success'>Yes</label>
        @else
            <label class='badge badge-dark'>No</label>
        @endif
    </td>

    <td class="text-capitalize">
        @if($list->status == 'expired')
            <label class='badge badge-danger'>Expired</label>
        @elseif($list->status == 'expiring')
            <label class='badge badge-warning'>Expiring</label>
        @else
            <label class='badge badge-success'>Active</label>
        @endif
    </td>

    <td>

        <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="viewrecord btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.view')"> <i class="fad fa-eye"></i></a>


        {{-- <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a> --}}


        <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>

    </td>



</tr>

@endforeach

