@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize limittablechar">{{ $list->name ?? '--' }}</td>
    <td class="text-capitalize limittablechar">{{ $list->email ?? '--' }}</td>
    <td class="text-capitalize">{{$list->subject ?? '--' }}</td>
    <td class="text-capitalize limittablechar">{{$list->message ?? '--' }}</td>
    <td class="text-capitalize">
        @if($list->is_converted == 1 )
            <label class='badge badge-success'>Yes</label>
        @else
            <label class='badge badge-dark'>No</label>
        @endif
    </td>

    <td class="text-capitalize">
        @if($list->is_replied == 1 )
            <label class='badge badge-success'>Yes</label>
        @else
            <label class='badge badge-dark'>No</label>
        @endif
    </td>
    <td>

        @can('view_enquiry')
            <a href="javascript:void(0)" data-type="table"  data-id="{{ Crypt::encryptString($list->id) }}" class="viewrecord btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary rounded-circle" title="view record"><i class="fad fa-eye"></i></a>
        @endcan

        @can('reply_enquiry')
            <a href="javascript:void(0)" data-type="table" data-email="{{$list->email}}" data-id="{{encryptId($list->id)}}"  class="replynow btn btn-icons btn-rounded btn-outline-warning btn-inverse-warning rounded-circle" title="reply now"><i class="fad fa-reply"></i></a>
        @endcan

        @can('convert_enquiry')
            @if($list->is_converted != 1 )
                <a href="javascript:void(0)" data-type="table"  data-id="{{ Crypt::encryptString($list->id) }}" class="moverecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info rounded-circle" title="move to contact"><i class="fad fa-exchange-alt"></i></a>
            @endif
        @endcan

        @can('delete_enquiry')
            <a href="javascript:void(0)" data-type="table"  data-id="{{ Crypt::encryptString($list->id) }}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle" title="delete record"><i class="fad fa-trash-alt"></i></a>
        @endcan

    </td>
</tr>

@endforeach

