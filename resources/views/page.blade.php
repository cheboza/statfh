@extends('layouts.app')

@section('title-page')
    {{$title}}
@endsection

@section('title')
    {{$title}}
@endsection

@section('content')
    <div class="content">
        @component('layouts/menu', ['menu' => $menu])
        @endcomponent
        <div class="content_stat">
            @component('layouts/content/filters', ['salePoints' => $salePoints, 'brands' => $brands, 'categories' => $categories])
            @endcomponent
            <div id="content_statChart"></div>
            @if(Request::is(['goods', 'collections']))
                <div id="content_statGoods">
                    <h4>Выбранные товары</h4>
                </div>
            @endif
        </div>
    </div>

    @component('layouts/content/modal')
    @endcomponent

    <script type="text/javascript" src="{{ asset('/js/manifest.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/lib/chart.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/js/'.request()->path().'.js') }}"></script>
@endsection