@extends('admin.layout')

@section('title', 'Permission profil')

@section('content')
    @include('admin.permissions.roles.mwc', ['Active' => '0'])
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-2"></div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Informations sur la permission</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-4"><mwc-textfield class="w-100" label="Nom" outlined="" value="{{ $permission->name }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Route" outlined="" value="{{ $permission->route }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Créé le" outlined="" value="{{ $permission->created_at }}" disabled=""></mwc-textfield></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
@endsection
