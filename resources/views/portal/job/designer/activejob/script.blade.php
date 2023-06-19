

@section('bottom_js')
@parent

<script language="javascript">

    @section('initiate_ajax_load')
        @parent
        getdatalist( '' );

    @endsection

</script>

@endsection
