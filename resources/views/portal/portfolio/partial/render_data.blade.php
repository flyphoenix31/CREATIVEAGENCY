@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize limittablechar">{{ $list->title ?? '--' }}</td>
    <td class="text-capitalize ">{{ $list->tag ?? '--' }}</td>
    <td class="text-capitalize">
        @if($list->is_featured == 1 )
            <label class='badge badge-primary'>Yes</label>
        @else
            <label class='badge badge-dark'>No</label>
        @endif
    </td>
    <td class="text-capitalize ">
        <div class="avatar avatar-xl">
            <img id="image_img_{{ $list->id }}" src=""  data-src="{{ $list->thumb }}" data-id="{{$list->id}}" class="lazy rounded changemainimage" >
        </div>
    </td>
    <td class="text-capitalize ">
        <div class="avatar avatar-xl">
            <img id="banner_img_{{ $list->id }}" src=""  data-src="{{ $list->bannerthumb }}" data-id="{{$list->id}}" class="lazy rounded changebannerimage" >

        </div>
    </td>
    <td class="text-capitalize">
        @if($list->status_id == 1 )
            <label class='badge badge-success'>Active</label>
        @else
            <label class='badge badge-dark'>Inactive</label>
        @endif
    </td>
    <td>

        {{-- <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="viewrecord btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.view')"> <i class="fad fa-eye"></i></a>
 --}}
        <a href="{{route('edit_portfolio', encryptId($list->id))}}" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>

        <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>
    </td>



</tr>

@endforeach

