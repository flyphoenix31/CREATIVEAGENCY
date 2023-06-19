
<section class="actions">
    @include('portal.job.manager.partial.action')
</section>

<section class="filter">
    @include('portal.job.manager.partial.filter')
</section>

<section class="datalist">
    @include('portal.job.manager.partial.ajaxlist')
</section>

<section class="pm_modal">
    @include('portal.job.manager.modal.modal')
</section>

@include('portal.job.manager.script')
