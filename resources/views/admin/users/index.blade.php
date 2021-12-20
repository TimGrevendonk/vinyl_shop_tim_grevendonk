@extends('layouts.template')

@section('title', 'Users')

@section('main')
    <h1>users</h1>
    @include('shared.alert')
    @include('admin.users.search')
    {{ $users->withQueryString()->links() }}
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Email</th>
                <th>Active</th>
                <th>Admin</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->active === 1)
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                    @if($user->admin == 1)
                            <i class="fas fa-check"></i>
                    @endif
                    </td>
                    <td>
                        <form action="/admin/users/{{ $user->id }}" method="post">
                            @csrf
                            @method('delete')
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $user->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger deleteUser"
                                        data-toggle="tooltip"
                                        data-name="{{$user->name}}"
                                        title="Delete {{ $user->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->withQueryString()->links() }}
@endsection

@section('script_after')
    <script>
        $('.deleteUser').click(function () {
            const userName = $(this).data('name');
            let msg = `Delete the user "${userName }"?`;
            if (confirm(msg)) {
                $(this).closest('form').submit();
            }
        })
    </script>
@endsection
