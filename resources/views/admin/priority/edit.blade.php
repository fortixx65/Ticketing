@extends('admin.layout')

@section('title', 'Priority Edit')

@section('content')
    @include('admin.priority.mwc', ['Active' => '1'])
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Parametre du role</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <div class="card-title">Supprimer la priorité</div>
                        <br>
                        <div class="card-subtitle mb-4">Une fois supprimé, la priorité sera définitivement supprimé !</div>
                        <a type="button" class="btn btn-danger mdc-ripple-upgraded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $priority->id }}" class="mx-1" title="Modifier" data-toggle="tooltip">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Éditer la priorité</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('admin.priority.editer', $priority) }}">
                        @csrf
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" name="name" value="{{ $priority->name }}">
                                <label for="floatingInput">Nom</label>
                            </div>
                        </div>
                        <div class="text-end"><button class="btn btn-primary mdc-ripple-upgraded" type="submit">Enregistrer les modifications</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete{{ $priority->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal">Supprimer {{ $priority->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">Confirmer la suppression de {{ $priority->name }}</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-outline-danger" href="{{ route('admin.priority.delete', $priority->id) }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
@endsection
