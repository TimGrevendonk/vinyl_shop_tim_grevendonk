<form method="get" action="/shop" id="searchForm">
    <div class="row">
        <div class="col-sm-7 mb-2">
            <input type="text" class="form-control" name="artist" id="artist"
                   value="{{ request()->artist }}"
                   placeholder="Filter Artist Or Record">
        </div>
        <div class="col-sm-5 mb-2">
            <select class="form-control" name="genre_id" id="genre_id">
{{--            lists "all genres" though a mysql wildcard (%) --}}
                <option value="%">All genres</option>

{{--                give all generes for the dropdown--}}
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ (request()->genre_id ==  $genre->id ? 'selected' : '') }}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
<hr>
