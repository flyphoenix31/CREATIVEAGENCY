@php
$page_name         = $attri['page_name']        ?? '';
$has_scrollspy     = $attri['has_scrollspy']    ?? '0';
$scrollspy_offset  = $attri['scrollspy_offset'] ?? '';
$alt_menu          = $attri['alt_menu']         ?? '0';
$category_name     = $attri['category_name']    ?? '';
$has_action_btn    = $attri['has_action_btn']   ?? '';
//echo $category_name;
$template = 'cork';
$theme    = $template. '/' . 'light'."/";

@endphp


@if(session()->has('darkmode'))
	@php $theme = 'dark'."/";	@endphp
@endif

@extends('portal.layouts.file')

@section('content')
    @if (isset($page))
        @include('portal.'.$page)
    @endif
@endsection
