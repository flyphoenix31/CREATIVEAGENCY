@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ $list->id }}</td>
    <td class="text-capitalize">{{ $list->updated_at->format('M d Y') }}</td>
    <td class="text-capitalize">
        <a href="{{route('preview_invoice', encryptId($list->invoice->id ?? ''))}}">
            <span  class="text-primary inv-number">{{ $list->invoice->invoice_number ?? '' }} </span>
        </a>
    </td>
    <td class="text-capitalize ">{{ $list->to_email ?? '--' }}</td>
    <td class="text-capitalize ">{{ $list->view_count }}</td>
    <td><span class="">{{ $list->user->name  ?? '--'}}</span></td>
    <td data-id="{{ $list->id }}" class="text-capitalize changestatus">
        @if($list->status_id == 1 )
            <label class='badge badge-success'>Active</label>
        @else
            <label class='badge badge-dark'>Inactive</label>
        @endif
    </td>



</tr>

@endforeach

