@extends('admin.layout')

@section('title', 'Type edit')

@section('content')
    @include('admin.types.mwc', ['Active' => '1'])
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
                        <div class="card-title">Supprimer le type</div>
                        <br>
                        <div class="card-subtitle mb-4">Une fois supprimé, le type sera définitivement supprimé !</div>
                        <a type="button" class="btn btn-danger mdc-ripple-upgraded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $type->id }}" class="mx-1" title="Modifier" data-toggle="tooltip">Supprimer</a>
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
                            <h2 class="card-title text-white mb-0">Éditer le type</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('admin.types.editer', $type) }}">
                        @csrf
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" name="name" value="{{ $type->name }}">
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
    <div class="modal fade" id="modalDelete{{ $type->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal">Supprimer {{ $type->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">Confirmer la suppression de {{ $type->name }}</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-outline-danger" href="{{ route('admin.types.delete', $type->id) }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Récupérer l'élément du sélecteur et la boîte de couleur
        const colorPicker = document.getElementById("color-picker");
        const colorBox = document.getElementById("color-box");

        // Ajouter un événement pour changer la couleur de la boîte lorsque l'utilisateur choisit une couleur
        colorPicker.addEventListener("input", function() {
            // Appliquer la couleur choisie au fond de la boîte
            colorBox.style.backgroundColor = colorPicker.value;
        });
    </script>
@endsection
