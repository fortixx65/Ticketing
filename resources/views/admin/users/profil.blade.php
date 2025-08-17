@extends('admin.layout')

@section('title', 'User profil')

@section('content')
    @include('admin.users.mwc', ['Active' => '0'])
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Skin de l'utilisateur</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <!-- Profile picture image-->
                        <img class="img-fluid rounded-circle mb-1" src="https://cdn.discordapp.com/avatars/1008839757779976306/02bcdaf934a649fafa23c29c92423c00.webp" alt="..." style="max-width: 150px; max-height: 150px">
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
                            <h2 class="card-title text-white mb-0">Informations de l'utilisateur</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-4" disabled=""><mwc-textfield class="w-100" label="Pseudo" outlined="" value="{{ $user->name }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Email" outlined="" value="{{ $user->email }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Role" outlined="" value="{{ $user->role->name }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Inscrit le" outlined="" value="{{ $user->created_at }}" disabled=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Status" outlined="" value=" @if ($user->status == 1) Actif @else Inactif @endif" disabled=""></mwc-textfield></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
