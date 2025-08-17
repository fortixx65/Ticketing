@extends('admin.layout')

@section('title', 'Role premissions')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection


@section('content')
    @include('admin.roles.mwc', ['Active' => '1'])
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Liste des permissions du role</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
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
                                                        @if ($trie->exist == true)
                                                            <div class="text-end"><mwc-switch id="Check{{ $trie->id }}" value="false" onclick="onChangeHandler({{ $trie->id }}, {{ $role->id }})" selected></mwc-switch></div>
                                                        @else
                                                            <div class="text-end"><mwc-switch id="Check{{ $trie->id }}" value="true" onclick="onChangeHandler({{ $trie->id }}, {{ $role->id }})"></mwc-switch></div>
                                                        @endif
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/sortablejs/Sortable.min.js') }}"></script>
    <script>
        function onChangeHandler(permissionId, roleId) {
            var isChecked = document.getElementById("Check" + permissionId).value;
            if (isChecked === "true") {
                document.getElementById("Check" + permissionId).value = "false";
            } else if (isChecked === "false") {
                document.getElementById("Check" + permissionId).value = "true";
            }
            // Envoi de la mise à jour au serveur
            fetch("/api/update-status", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Protection Laravel CSRF
                    },
                    body: JSON.stringify({
                        status: isChecked,
                        permission_id: permissionId,
                        role_id: roleId,
                        user_id: {{Auth::user()->id}},
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        const notyf = new Notyf({
                            duration: 3000,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                        });
                        notyf.success(data.message);
                    } else {
                        const notyf = new Notyf({
                            duration: 3000,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                        });
                        notyf.error("Erreur");
                    }
                })
        }
    </script>
@endsection
