@extends('admin.layout')

@section('title', 'User edit')

@section('css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <style>
        .datepicker-container {
            background: rgb(255, 255, 255);
            padding: 12px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: left;
        }

        .flatpickr-input {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #aaa;
            text-align: center;
            width: 220px;
            font-size: 16px;
        }

        .flatpickr-calendar {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.2);
        }

        .flatpickr-day {
            border-radius: 6px;
        }

        .flatpickr-day.selected {
            background-color: #ffffff !important;
            color: rgb(255, 0, 0) !important;
            font-weight: bold;
        }
    </style>
    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    @include('admin.users.mwc', ['Active' => '2'])
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Parametre de l'utilisateur</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if ($user->status == '0')
                        <div class="text-center">
                            <div class="card-title">Réactiver l'utilisateur</div>
                            <br>
                            <div class="card-subtitle mb-4">une fois activé, l'utilisateur pourra de nouveau se connecter !</div>
                            <a href="{{ route('admin.users.on', $user) }}" class="btn btn-success mdc-ripple-upgraded" type="button">Réactiver</a>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="card-title">Désactiver l'utilisateur</div>
                            <br>
                            <div class="card-subtitle mb-4">Une fois désactivé, l'utilisateur ne pourra plus se connecter !</div>
                            <a href="{{ route('admin.users.off', $user) }}" class="btn btn-danger mdc-ripple-upgraded" type="button">Désactiver</a>
                        </div>
                    @endif
                    <hr class="my-5">
                    <div class="text-center">
                        <div class="card-title">Supprimer l'utilisateur</div>
                        <br>
                        <div class="card-subtitle mb-4">Une fois supprimé, le utilisateur sera définitivement supprimé !</div>
                        <a type="button" class="btn btn-danger mdc-ripple-upgraded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $user->id }}" class="mx-1" title="Modifier" data-toggle="tooltip">Supprimer</a>
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
                            <h2 class="card-title text-white mb-0">Éditer le profil</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form method="post" action="{{ route('admin.users.editer', $user) }}">
                        @csrf
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" name="name" value="{{ $user->name }}">
                                <label for="floatingInput">Nom</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" value="{{ $user->email }}">
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group form-floating">
                                <select class="form-select" id="floatingSelectGrid" name="role" aria-label="Floating label select example">
                                    @foreach ($roles as $role)
                                        @if ($role->id == $user->role_id)
                                            <option value="{{ $role->id }}" selected="">{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">Role</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group form-floating">
                                <select class="form-select" id="response" onchange="showNextQuestions()">
                                    @if ($user->expired == null)
                                        <option value="no" id="expired" selected="">Non</option>
                                        <option value="yes">Oui</option>
                                    @else
                                        <option value="yes" id="expired" selected="">Oui</option>
                                        <option value="no">Non</option>
                                    @endif
                                </select>
                                <label for="floatingSelectGrid">Expliration de l'utilisateur</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div id="next-questions" class="hidden">
                                <div class="datepicker-container">
                                    <label for="datepicker" class="mb-2 font-semibold text-lg">Sélectionnez une date :
                                        <input type="text" id="datepicker" class="flatpickr-input" value="{{ $date }}"></label>
                                    <input type="hidden" id="formattedDate" name="expired" value="{{ $user->expired }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-end"><button class="btn btn-primary mdc-ripple-upgraded" type="submit">Enregistrer les changements</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal">Supprimer {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">Confirmation de la suppression de l'utilisateur {{ $user->name }}</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-outline-danger" href="{{ route('admin.users.delete', $user->id) }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let expired = document.getElementById('expired').value;
        if (expired === "yes") {
            document.getElementById('next-questions').classList.remove('hidden');
        }

        function showNextQuestions() {
            let response = document.getElementById('response').value;
            if (response === "yes") {
                document.getElementById('next-questions').classList.remove('hidden');
            } else {
                document.getElementById('next-questions').classList.add('hidden');
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                const datepicker = document.getElementById("datepicker");
                const formattedDateInput = document.getElementById("formattedDate");
                if (datepicker) {
                    const fp = flatpickr(datepicker, {
                        dateFormat: "d F Y",
                        minDate: "today",
                        disableMobile: true,
                        locale: "fr",
                        position: "auto center",
                        onChange: function(selectedDates, dateStr, instance) {
                            if (selectedDates.length > 0) {
                                const formattedDate = flatpickr.formatDate(selectedDates[0], "Y/m/d");
                                formattedDateInput.value = formattedDate;
                            }
                        }
                    });

                    // Ajouter la navigation avec la molette de la souris
                    document.querySelector(".flatpickr-calendar").addEventListener("wheel", function(event) {
                        event.preventDefault();
                        if (event.deltaY < 0) {
                            fp.changeMonth(-1); // Molette vers le haut : mois précédent
                        } else {
                            fp.changeMonth(1); // Molette vers le bas : mois suivant
                        }
                    });
                } else {
                    console.error("Élément #datepicker introuvable");
                }
            }, 100);
        });
    </script>
@endsection
