<form method="get" action="/users" id="searchForm">
    <div class="row">
        <div class="col-sm-7 mb-2">
            <input type="text" class="form-control" name="filter" id="filter"
                   value="{{ request()->artist }}"
                   placeholder="Filter Name or Email">
        </div>
        <div class="col-sm-5 mb-2">
            <select class="form-control" name="user_id" id="user_id">
                {{--            lists "all users" though a mysql wildcard (%) --}}
                <option value="%">All users</option>

                {{--                give all generes for the dropdown--}}
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ (request()->user_id ==  $user->id ? 'selected' : '') }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
<hr>
