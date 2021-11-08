@extends('layouts.template')

@section('title', 'Itunes')

@section('main')
    <h1>itunes {{ $feed['title'] }} - {{ $feed['country'] }}</h1>
    <div class="row">
        @foreach($results as $result)
            <div class="col-sm-4 card cardShopMaster">
                <img class="card-img-top"
                     src="/assets/vinyl.png"
                     data-src="{{ $result['artworkUrl100'] }}"
                     alt="{{ $result['artistName'] }}">
                <div class="card-body ">
                    <p>
                        <b>{{ $result['artistName'] }}</b><br>
                        {{ $result['name'] }}
                    </p></div>
                <div class="card-footer d-flex justify-content-between">
                    <hr>
                    <p>
                        genre: <b>{{ $result['genres'][0]['name'] }}</b><br>
                        artist URL: <a href="{{ $result['artistUrl']}}">{{ $result['artistName'] }}</a>
                    </p>
                </div>
            </div>

        @endforeach
    </div>
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
