@extends('admin.layout')

@section('title', 'Permissions Roles')

@section('content')
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des permissions</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Route</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td scope="row">{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->route }}</td>
                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.permissions.roles.profil', $permission) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end py-3">
                <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Modifier" data-toggle="tooltip">Créer une permission</i></a>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route('admin.permissions.roles.create') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer une nouvelle permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" name="name" required>
                                <label for="floatingInput">Nom de la permission</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="route" required>
                                <label for="floatingInput">Route de la permission</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Créer la permission</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
