@extends('admin.layout')

@section('title', 'Users')

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
@endsection

@section('content')
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
                        <th scope="col">role</th>
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
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.users.profil', $user) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end py-3">
                <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Modifier" data-toggle="tooltip">Ajouter un utilisateur</i></a>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route('admin.users.create') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <div class="form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" name="name" value="" required>
                                <label for="floatingInput">Nom</label>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" value="" required>
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" value="" required>
                                <label for="floatingInput">Mot de passe</label>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" required>
                                <label for="floatingInput">Confirmer le mot de passe</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <span id="message" style="color: red;"></span>
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <div class="input-group form-floating">
                                <select class="form-select" id="floatingSelectGrid" name="role" aria-label="Floating label select example">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">Role</label>
                            </div>
                        </div>

                        <!-- Expired -->
                        <div class="mb-3">
                            <label>
                                Est-ce un utilisateur temporaire ? <input type="checkbox" id="toggleQuestions">
                            </label>
                        </div>
                        <div class="mb-3 flex" id="additionalQuestions" style="display: none;">
                            <div class="datepicker-container">
                                <label for="datepicker" class="mb-2 font-semibold text-lg">Sélectionnez une date :
                                    <input type="text" id="datepicker" class="flatpickr-input" placeholder="Cliquez pour choisir"></label>
                                <input type="hidden" id="formattedDate" name="expired">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Créer l'utilisateur</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Sélection des champs du formulaire
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("password_confirmation");
        const message = document.getElementById("message");

        function verifierMotDePasse() {
            // Si les deux champs sont vides, on enlève le message
            if (password.value === "" && confirmPassword.value === "") {
                message.textContent = "";
                confirmPassword.style.borderColor = "";
                return;
            }

            // Vérification si les mots de passe correspondent
            if (password.value === confirmPassword.value) {
                message.textContent = ""; // Supprime le message d'erreur
                confirmPassword.style.borderColor = "green";
            } else {
                message.textContent = "Les mots de passe ne correspondent pas.";
                confirmPassword.style.borderColor = "red";
            }
        }

        // Vérifie en temps réel lorsque l'utilisateur tape dans l'un des deux champs
        password.addEventListener("input", verifierMotDePasse);
        confirmPassword.addEventListener("input", verifierMotDePasse);

        // Vérification avant soumission du formulaire
        function validerFormulaire() {
            if (password.value !== confirmPassword.value) {
                alert("Les mots de passe ne correspondent pas !");
                return false; // Empêche l'envoi du formulaire
            }
            return true;
        }
    </script>

    <script>
        document.getElementById('toggleQuestions').addEventListener('change', function() {
            let additionalQuestions = document.getElementById('additionalQuestions');
            additionalQuestions.style.display = this.checked ? 'block' : 'none';
        });
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
