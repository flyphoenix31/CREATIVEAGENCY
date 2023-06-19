@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>    
    <td class="text-capitalize">{{$list->name}}</td>    
    <td>        
        <a href="javascript:void(0)" data-id="{{ $list->id }}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"><i class="fad fa-pencil-alt"></i></a>        

        @if(!$list->is_locked)
            <a href="javascript:void(0)" data-id="{{ $list->id }}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"><i class="fad fa-trash" data-toggle="tooltip" data-placement="top" title="@lang('lang.delete')"></i></a>
        @endif



    </td> 
</tr>

@endforeach
