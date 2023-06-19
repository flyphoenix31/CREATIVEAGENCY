@foreach($result as $list)

<tr id="tr_{{$list->id}}">

    <td><input class="checkbox checkItem" type="checkbox" data-id="{{$list->id}}" id="checkItem" id="checkItem[{{$list->id}}]"></td>
    <td class="">{{$list->id}}</td>
    <td class="">{{ \Carbon\Carbon::parse($list->created_at)->formatLocalized('%d/%b/%y')}}</td>
    <td class="text-capitalize">{{$list->name}} </td>
    <td>{{$list->username ?? '-'}} </td>
    <td>{{$list->email ?? ''}} </td>
    <td>@foreach ($list->roles()->pluck('name') as $role)
        <span class="badge badge-primary badge-many">{{ $role }}</span> @endforeach
    </td>
    <td data-id="{{ $list->id }}" class="changestatus">
        @if($list->status_id)
        <label class="text-capitalize badge badge-{{$list->status->color ?? 'dark'}}">
            {{trans('lang.' . $list->status->name )}}
        </label>
        @else
        -
        @endif
    </td>
    <td>
        <a href="javascript:void(0)" data-id="{{$list->id}}" id="{{$list->id}}" class="editrecord btn btn-icons btn-rounded btn-outline-info btn-inverse-info  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-pencil-alt"></i></a>

        <a href="javascript:void(0)" data-id="{{ $list->id }}" class="changepassword btn btn-icons btn-rounded btn-outline-warning btn-inverse-warning rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.reset') @lang('lang.password')"><i class="fad fa-key"></i></a>

        <a href="javascript:void(0)" data-id="{{$list->id}}" id="{{$list->id}}" class="deleterecord btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"  title="@lang('lang.delete')" ><i class="fad fa-trash"></i></a>
    </td>
</tr>

@endforeach
