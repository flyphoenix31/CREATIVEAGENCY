<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{$list->code}}</td>
    <td class="text-capitalize">{{$list->country_name}}</td>
    <td class="text-capitalize">{{$list->symbol}}</td>
    <td class="text-capitalize">
        @if($list->is_active == 1 )
            <label class='badge badge-success'>Active</label>
        @else
        <label class='badge badge-dark'>Inactive</label>
        @endif
    </td>

    <td class="text-capitalize">
        @if($list->is_active != 1 )
            <a href="javascript:void(0)" data-id="{{ Crypt::encryptString($list->id) }}" class="activeRow btn btn-outline-primary btn-inverse-primary">Make It Active</a>
        @else
            <a href="javascript:void(0)" data-id="{{ Crypt::encryptString($list->id) }}" class="disableRow btn btn-outline-warning btn-inverse-warning">Disable</a>
        @endif
    </td>




</tr>
