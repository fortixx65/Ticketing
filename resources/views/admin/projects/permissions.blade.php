@extends('admin.layout')

@section('title', 'Project permissions')

@section('content')
    @include('admin.projects.mwc', ['Active' => '2'])
    <!-- Divider-->
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Info des Assignations</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <!-- Profile picture image-->
                        <div class="h6 mb-1">Il y a assigations</div>
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
                            <h2 class="card-title text-white mb-0">Liste des Assignations</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Null</th>
                                <th scope="col">Null</th>
                                <th scope="col">Null</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Null</th>
                                <td>Null</td>
                                <td>Null</td>
                                <td>Null</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-end py-3">
                        <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Create" data-toggle="tooltip">Null</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal Create-->
        {{-- <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route("admin.enchantments.assignCreate", $enchantment->id) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau catalogue</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="item_id">
                                @foreach ($items as $item){
                                    <option name="{{ $item->name }}" value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                }
                                @endforeach
                            </select>
                            <label for="floatingInput">Item</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="nbr" type="number" placeholder="Nombre" value=""required>
                            <label for="floatingInput">Nombre</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Cree le catalogue</button>
                    </div>
                </div>
            </form>
        </div> --}}

    @endsection
