@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{$loop->iteration}}</td>
    <td class="text-capitalize">{{$list->mail_driver}}</td>
    <td class="text-capitalize">{{$list->mail_port}}</td>
    <td class="text-capitalize">{{$list->display_name}}</td>
    <td class="text-capitalize">{{$list->from_address}}</td>
    <td class="text-capitalize">{{$list->mail_username}}</td>
    <td class="text-capitalize">
        @if($list->is_default == 1 )
            <label class='badge badge-success'>Default & Activated</label>
        @else
            <a href="javascript:void(0)" data-id="{{ Crypt::encryptString($list->id) }}" class="changeaccount btn btn-outline-primary btn-inverse-primary">Make It Default</a>
        @endif
    </td>
    <td>


            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>

            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>

    </td>



</tr>

@endforeach

