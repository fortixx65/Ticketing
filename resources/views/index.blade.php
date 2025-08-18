@extends('layout')

@section('title', 'Tickets')

@section('content')

<h1>Ticketing</h1>

<div class="container-xl p-5">
                        
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                    <div class="card-body p-5">
                        <!-- Auth header with logo image-->
                        <div class="text-center">
                            <h1 class="display-5 mb-0">Se connecter</h1>
                            <div class="subheading-1 mb-5">to continue to app</div>
                        </div>
                        <div class="text-center mb-5"><a class="small fw-500 text-decoration-none" href="{{ route("admin.projects.index")}}">Admin</a></div>
                        <br>
                        <div class="text-center mb-5"><a class="small fw-500 text-decoration-none" href="{{ route("tickets.clients.index")}}">Clients</a></div>
                        <br>
                        <div class="text-center mb-5"><a class="small fw-500 text-decoration-none" href="{{ route("tickets.supports.index")}}">Supports</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection