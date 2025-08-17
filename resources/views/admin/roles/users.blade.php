@extends('admin.layout')

@section('title', 'Role users')

@section('content')

    @include('admin.roles.mwc', ['Active' => '2'])
    <hr class="mt-0 mb-5">
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des utilisateurs</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">created_at</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.users.profil', $user) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
