@extends('admin.layout')

@section('title', 'Project edit')

@section('css')
    <style>
        /* Styles Material Design */
        .multi-select-container {
            position: relative;
            width: 100%;
        }

        .selected-items {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            min-height: 50px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        /* .selected-items:hover {
            border-color: #3f51b5;
        } */

        .selected-items .chip {
            display: flex;
            align-items: center;
            background: #3f51b5;
            color: white;
            padding: 5px 10px;
            margin: 3px;
            border-radius: 16px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .selected-items .chip:hover {
            background: #303f9f;
        }

        .selected-items .chip .material-icons {
            font-size: 16px;
            margin-left: 5px;
            cursor: pointer;
        }

        .dropdown {
            position: absolute;
            width: 100%;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }

        .dropdown .option {
            padding: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .dropdown .option:hover {
            background: #3f51b5;
            color: white;
        }

        .dropdown .option.selected {
            background: #e3f2fd;
            color: #3f51b5;
        }

        /* label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            color: #3f51b5;
        } */
    </style>
@endsection

@section('content')
    @include('admin.projects.mwc', ['Active' => '3'])
    <hr class="mt-0 mb-5">
    <!-- Profile content row-->
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Parametre du projet</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if ($project->status == '1')
                        <div class="text-center">
                            <div class="card-title">Désactiver le projet</div>
                            <br>
                            <div class="card-subtitle mb-4">une fois desactiver, le projet ne pourra plus etre assecible !</div>
                            <a href="{{ route('admin.projects.off', $project) }}" class="btn btn-danger mdc-ripple-upgraded" type="button">Désactiver</a>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="card-title">Réactiver le projet</div>
                            <br>
                            <div class="card-subtitle mb-4">Une fois activé, le projet pourra de nouveau etre assecible !</div>
                            <a href="{{ route('admin.projects.on', $project) }}" class="btn btn-success mdc-ripple-upgraded" type="button">Réactiver</a>
                        </div>
                    @endif
                    <hr class="my-5">
                    <div class="text-center">
                        <div class="card-title">Supprimer le projet</div>
                        <br>
                        <div class="card-subtitle mb-4">Une fois supprimé, le projet sera définitivement supprimé !</div>
                        <a type="button" class="btn btn-danger mdc-ripple-upgraded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $project->id }}" class="mx-1" title="Modifier" data-toggle="tooltip">Supprimer</a>
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
                            <h2 class="card-title text-white mb-0">Modification du projet</h2>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.projects.editer', $project) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modifier {{ $project->name }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="floatingInput" name="name" value="{{ $project->name }}">
                                    <label for="floatingInput">Nom</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="floatingInput" name="content" value="{{ $project->content }}">
                                    <label for="floatingInput">Description</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="multi-select-container">
                                    <div class="selected-items" onclick="toggleDropdown()">
                                        <span id="placeholder">Roles associé</span>
                                    </div>
                                    <div class="dropdown">
                                        @foreach ($roles as $role)
                                            <div class="option" data-name="{{ $role->name }}" data-id="{{ $role->id }}" id="role_{{ $role->id }}">{{ $role->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="selected_roles" id="selected_roles">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mdc-ripple-upgraded">Sauvegarder les modifications</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const selectedItemsContainer = document.querySelector('.selected-items');
        const dropdown = document.querySelector('.dropdown');
        var placeholder = document.getElementById('placeholder');
        const hiddenInput = document.getElementById('selected_roles'); // Champ caché pour POST

        let selectedValues = [];
        let selectedNames = {};

        let startValue = @json($selectedRoles);

        function toggleDropdown() {
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        function selectOptionOnStart() {
            for (let i = 0; i < startValue.length; i++) {
                if (!selectedValues.includes("" + startValue[i].id + "")) {
                    selectedValues.push("" + startValue[i].id + "");
                    selectedNames[startValue[i].id] = startValue[i].name;
                    document.getElementById("role_" + startValue[i].id).classList.add("selected");
                }
            }
            updateSelectedItems();
        }

        function selectOption(event) {
            const id = event.target.getAttribute('data-id');
            const name = event.target.getAttribute('data-name');

            if (!selectedValues.includes(id)) {
                selectedValues.push(id);
                selectedNames[id] = name;
                updateSelectedItems();
                event.target.classList.add('selected');
            }
        }

        function removeItem(id) {
            selectedValues = selectedValues.filter(item => item !== id);
            delete selectedNames[id];
            updateSelectedItems();

            document.querySelectorAll('.dropdown .option').forEach(option => {
                if (option.getAttribute('data-id') === id) {
                    option.classList.remove('selected');
                }
            });
        }

        function updateSelectedItems() {
            console.log(selectedValues);
            selectedItemsContainer.innerHTML = "";

            if (selectedValues.length === 0) {
                let placeholder = '<span id="placeholder">Roles associé</span>';
                selectedItemsContainer.innerHTML = placeholder;
            }

            selectedValues.forEach(id => {
                const chip = document.createElement('div');
                chip.classList.add('chip');
                chip.innerHTML = `${selectedNames[id]} <span class="material-icons" onclick="removeItem('${id}')">close</span>`;
                selectedItemsContainer.appendChild(chip);
            });

            hiddenInput.value = selectedValues.join(",");
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.multi-select-container')) {
                dropdown.style.display = "none";
            }
        });

        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', selectOption);
            if (selectedValues.includes(option.getAttribute('data-id'))) {
                selectedNames[option.getAttribute('data-id')] = option.getAttribute('data-name');
            }
        });

        updateSelectedItems(); // Charge les projets déjà sélectionnés
        selectOptionOnStart();
    </script>
    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal">Supprimer {{ $project->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">Confirmer la suppression de {{ $project->name }}</div>
                    <div class="modal-body">Il supprimera tous les tickets associés à ce projet</div>
                    <div class="modal-body">Ainsi que tous les messages et temps associés à ces tickets</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-text-danger" href="{{ route('admin.projects.delete', $project->id) }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
@endsection
