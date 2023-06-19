@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize limittablechar">{{gettitle($list->title)}} {{ $list->name ?? '--' }}</td>
    <td class="text-capitalize ">{{ $list->email ?? '--' }}</td>
    <td class="text-capitalize">
        @if($list->status_id == 1 )
            <label class='badge badge-success'>Active</label>
        @else
            <label class='badge badge-dark'>Inactive</label>
        @endif
    </td>
    <td>
        @can('view_contact')
            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="viewrecord btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.view')"> <i class="fad fa-eye"></i></a>
        @endcan

        @can('edit_contact')
            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>
        @endcan

        @can('view_quotation')
            <a href="{{route('list_quotation', ['email' => $list->email])}}"  class="btn btn-icons btn-rounded btn-outline-dark btn-inverse-dark rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.view') @lang('lang.quotation')"><i class="fad fa-list-ul"></i></a>
        @endcan

        @can('delete_contact')
            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>
        @endcan
    </td>



</tr>

@endforeach

