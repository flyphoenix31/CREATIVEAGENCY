@foreach($result as $list)

<tr id="tr_{{$list->id}}">
    <td class="text-capitalize">{{ \Carbon\Carbon::parse($list->created_at)->formatLocalized('%d/%b/%y')}}</td>
    <td class="text-capitalize">{{ $list->getExtraProperty('type') }}</td>
    <td class="text-capitalize">{{ $list->causer->name ?? '' }}</td>
    <td class="text-capitalize">{{$list->description}}</td>
    <td class="text-capitalize">{{ $list->getExtraProperty('browser') }}</td>
    <td class="text-capitalize">{{ $list->getExtraProperty('ip') }}</td>

    <td>


            <a href="javascript:void(0)" data-id="{{encryptId($list->id)}}" id="{{encryptId($list->id)}}" class="viewrecord btn btn-icons btn-rounded btn-outline-primary btn-inverse-primary  rounded-circle" data-toggle="tooltip" data-placement="top" title="@lang('lang.edit')"> <i class="fad fa-eye"></i></a>

    </td>



</tr>

@endforeach

