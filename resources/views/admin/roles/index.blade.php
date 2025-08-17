@extends('admin.layout')

@section('title', 'Roles')

@section('content')
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des roles</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td scope="row">{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->color }}</td>
                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.roles.profil', $role) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end py-3">
                <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Modifier" data-toggle="tooltip">Céer un role</a>
            </div>
        </div>
    </div>
    <!-- Modal Create-->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route('admin.roles.create') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <mwc-tab-bar class="nav nav-tabs" role="tablist">
                            <mwc-tab id="profile-tab" label="Profile" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="true"></mwc-tab>
                            <mwc-tab id="permission-tab" label="Permission" data-bs-toggle="tab" data-bs-target="#permission" role="tab" aria-controls="permission" aria-selected="false"></mwc-tab>
                        </mwc-tab-bar>

                        <div class="tab-content border border-top-0 p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="mb-4">
                                    <div class="form-floating mb-3">
                                        <input type="name" class="form-control" id="floatingInput" name="name" value="">
                                        <label for="floatingInput">Nom</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="mb-3">
                                        <label for="floatingInput">Couleur</label>
                                        <input type="color" id="color-picker" name="color">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tab">
                                <div class="flex flex-row">
                                    <div class="card-title text-center">Administration</div>
                                    <hr class="my-5">
                                    <div class="row">
                                        @foreach ($sections as $section)
                                            <div class="card card-raised card-collapsible mb-4 col-4">
                                                <div class="card-header" data-bs-toggle="collapse" data-bs-target="#{{ $section->name }}" aria-expanded="true" aria-controls="{{ $section->name }}">{{ $section->name }}<i class="material-icons card-header-icon">expand_less</i></div>
                                                <div class="card-body collapse" id="{{ $section->name }}">
                                                    <p class="card-text">
                                                        @foreach ($section->perm as $trie)
                                                            <div class="card-subtitle row my-2">
                                                                <div class="col-8">{{ $trie->name }}</div>
                                                                <div class="col-4">
                                                                    <div class="text-end"><mwc-switch name="perm[]" value="{{ $trie->id }}"></mwc-switch>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="my-1">
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Créer le role</button>
                    </div>
                </div>
            </form>
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
