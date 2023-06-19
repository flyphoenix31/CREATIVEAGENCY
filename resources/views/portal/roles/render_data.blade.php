@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $loop->iteration }}</td>
    <td class="text-capitalize">{{$list->name}}</td>
    <td>
        @foreach( $list->permissions()->pluck('name')->chunk(7) as $chunk)
        </br>
            @foreach($chunk as $permission)
               <span class="badge badge-info badge-many mt-1 mb-1">{{ $permission }}</span>
            @endforeach
        @endforeach
    </td>
    <td>
        <a href="javascript:void(0)" data-id="{{ $list->id }}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info rounded-circle"><i class="fad fa-pencil-alt"></i></a>


        @if($list->name != 'superadmin')
            <a href="javascript:void(0)" data-id="{{ $list->id }}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"data-toggle="tooltip" data-placement="top" title="@lang('lang.delete')"><i class="fad fa-trash"></i></a>
        @endif

    </td>
</tr>

@endforeach
