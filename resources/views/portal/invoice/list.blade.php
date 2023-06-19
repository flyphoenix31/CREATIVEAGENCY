
<section class="actions">
    @include('portal.invoice.partial.action')
</section>

<section class="filter">
    @include('portal.invoice.partial.filter')
</section>

<section class="datalist">
    @include('portal.invoice.partial.ajaxlist')
</section>

<section class="pm_modal">
    @include('portal.invoice.modal.modal')
</section>

@include('portal.invoice.script')

@section('bottom_js')
@parent

<script language="javascript">

@section('initiate_ajax_load')
  @parent
  getdatalist( '' );

@endsection
</script>

@endsection
