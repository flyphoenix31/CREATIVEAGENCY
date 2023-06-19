@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td><a href="{{route('edit_invoice', encryptId($list->id))}}"><span  class="text-success inv-number">#{{ $list->invoice_number }}</span></a></td>
    <td>
        <p class="align-self-center mb-0 user-name"> {{ $list->client_name }} </p>
    </td>
    <td><span class="inv-email">{{ $list->client_email }}</span>
    </td>
    <td><span class="inv-date">{{ Carbon\Carbon::parse($list->invoice_date)->format('d M Y') }}</span></td>
    <td><span class="due-date">{{ Carbon\Carbon::parse($list->due_date)->format('d M Y') }}</span></td>
    <td><span class="inv-amount">{{$list->currency->symbol}}{{ number_format($list->grand_total, 2) }} </span></td>
    <td><span class="">{{ $list->user->name  ?? '--'}}</span></td>
    <td><span class="badge badge-{{ $list->status->color  ?? 'dark'}} inv-status">{{ $list->status->display_name  ?? 'unknown'}}</span></td>
    <td>
        @can('view_invoice')
            <a href="{{route('preview_invoice', encryptId($list->id))}}" class="btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.preview')"> <i class="fad fa-eye"></i></a>
        @endcan

        @can('email_invoice')
            <a href="javascript:void(0);" data-email="{{$list->client_email}}" data-id="{{encryptId($list->id)}}" class="btn btn-icons btn-rounded btn-outline-warning btn-inverse-warning  rounded-circle sendmail" data-toggle="tooltip" data-placement="top" title="@lang('lang.send') @lang('lang.mail')"> <i class="fad fa-paper-plane"></i></a>
        @endcan

        @can('edit_invoice')
            <a href="{{route('edit_invoice', encryptId($list->id))}}" class="btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>
        @endcan

        @can('delete_invoice')
            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>
        @endcan
    </td>
</tr>

@endforeach
