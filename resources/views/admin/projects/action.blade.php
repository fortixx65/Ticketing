@extends('admin.layout')

@section('title', 'Project profil')

@section('content')
    @include('admin.projects.mwc', ['Active' => '0'])
    <!-- Divider-->
    <hr class="mt-0 mb-5">
    <!-- Profile content row-->
    <div class="row gx-5">
        <div class="col-xl-4">

            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Informations général sur l'outil</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-4"><mwc-textfield class="w-100" label="Name" outlined="" value="{{ $project->name }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Status" outlined="" value="{{ $project->status() }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Cree le" outlined="" value="{{ $project->created_at }}" disabled=""></mwc-textfield></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Stats de l'outils</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">50</div>
                            <div class="card-text">Tickets support</div>
                        </div>
                        <div class="icon-circle bg-black-50 text-primary"><i class="material-icons">download</i></div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="material-icons icon-xs">arrow_upward</i>
                            <div class="caption fw-500 me-2">3%</div>
                            <div class="caption">que le mois dernier</div>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="text-center">
                        <div class="card-title">Activer l'item</div>
                        <br>
                        <div class="card-subtitle mb-4">L'item est actuellement desactiver, voulez vous l'activer ?</div>
                        <a href="" class="btn btn-success mdc-ripple-upgraded" type="button">Activer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
