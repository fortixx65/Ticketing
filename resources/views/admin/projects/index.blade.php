@extends('admin.layout')

@section('title', 'Procject')

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
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des projects</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">description</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td scope="row">{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->content }}</td>
                            <td>{{ $project->status() }}</td>
                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.projects.action', $project) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end py-3">
                <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Modifier" data-toggle="tooltip">Ajouter un projet</i></a>
            </div>
        </div>
    </div>
    <!-- Modal Create-->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route('admin.projects.create') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" name="name" required>
                                <label for="floatingInput">Nom du projet</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" name="content" required>
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
                                        <div class="option" data-name="{{ $role->name }}" data-id="{{ $role->id }}">{{ $role->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="selected_roles" id="selected_roles">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Créer le projet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    const selectedItemsContainer = document.querySelector('.selected-items');
    const dropdown = document.querySelector('.dropdown');
    const placeholder = document.getElementById('placeholder');
    const hiddenInput = document.getElementById('selected_roles'); // Champ caché pour POST

    let selectedValues = []; // Stocke les ID
    let selectedNames = {};  // Associe ID -> Nom

    function toggleDropdown() {
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    function selectOption(event) {
        const id = event.target.getAttribute('data-id');   // Récupère l'ID
        const name = event.target.getAttribute('data-name'); // Récupère le Nom

        if (!selectedValues.includes(id)) {
            selectedValues.push(id);
            selectedNames[id] = name;  // Associe l'ID à son nom
            updateSelectedItems();
            event.target.classList.add('selected');
        }
    }

    function removeItem(id) {
        selectedValues = selectedValues.filter(item => item !== id);
        delete selectedNames[id];  // Supprime l'association ID -> Nom
        updateSelectedItems();

        document.querySelectorAll('.dropdown .option').forEach(option => {
            if (option.getAttribute('data-id') === id) {
                option.classList.remove('selected');
            }
        });
    }

    function updateSelectedItems() {
        selectedItemsContainer.innerHTML = "";

        if (selectedValues.length === 0) {
            placeholder.style.display = "block";
        } else {
            placeholder.style.display = "none";
        }

        selectedValues.forEach(id => {
            const chip = document.createElement('div');
            chip.classList.add('chip');
            chip.innerHTML = `${selectedNames[id]} <span class="material-icons" onclick="removeItem('${id}')">close</span>`;
            selectedItemsContainer.appendChild(chip);
        });

        // Met à jour la valeur du champ caché avec les IDs
        hiddenInput.value = selectedValues.join(",");
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.multi-select-container')) {
            dropdown.style.display = "none";
        }
    });

    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', selectOption);
    });
</script>
@endsection
