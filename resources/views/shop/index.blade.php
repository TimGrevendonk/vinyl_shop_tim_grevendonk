@extends('layouts.template')

@section('title', 'Shop')

@section('css_after')
   {{-- <style>
        .card {
            cursor: pointer;
        }
        .card .btn, form .btn {
            display: none;
        }
    </style>--}}
@endsection


@section('main')
    <h1>Shop</h1>
{{--  search function--}}
    @include("shop.search")
    @if ($records->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any artist or album with <b>'{{ request()->artist }}'</b>
            @if ( request()->genre_id != "%" )
            for this genre <b>'{{ $order[request()->genre_id -1]->name }}'</b>
            @endif
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    {{ $records->withQueryString()->links() }}
    <div class="row">
        @foreach($records as $record)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-content-stretch">
            <div class="card cardShopMaster" data-id="{{ $record->id }}">
                <img class="card-img-top" src="/assets/vinyl.png" data-src="{{ $record->cover }}" alt="{{ $record->artist }} - {{ $record->title }}">
                <div class="card-body ">
                    <h5 class="card-title">{{ $record->artist }}</h5>
                    <p class="card-text">{{ $record->title }}</p>
                    <a href="shop/{{ $record->id }}" class="btn btn-outline-info btn-sm btn-block">Show details</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p>{{ $record->genre->name }}</p>
                    <p>
                        € {{ number_format($record->price,2) }}
                        <span class="ml-3 badge {{ $record->badge }}">{{ $record->stock }}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
{{--    {{ $records->links() }}--}}
    {{ $records->withQueryString()->links() }}
@endsection

@section('script_after')
    <script>
        $(function () {
            // Get record id and redirect to the detail page
            $('.card').click(function () {
                const record_id = $(this).data('id');
                $(location).attr('href', `/shop/${record_id}`); //OR $(location).attr('href', '/shop/' + record_id);
            });
            // Replace vinyl.png with real cover
            $('.card img').each(function () {
                $(this).attr('src', $(this).data('src'));
            });
            // Add shadow to card on hover
            $('.card').hover(function () {
                $(this).addClass('shadow');
            }, function () {
                $(this).removeClass('shadow');
            });
            // submit form when leaving text field 'artist'
            $('#artist').blur(function () {
                $('#searchForm').submit();
            });
            // submit form when changing dropdown list 'genre_id'
            $('#genre_id').change(function () {
                $('#searchForm').submit();
            });
        })
    </script>
@endsection


