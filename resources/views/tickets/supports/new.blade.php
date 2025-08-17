@extends('tickets.supports.elements.layout')

@section('title', 'Tickets')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/combine/npm/sceditor@3/minified/sceditor.min.js,npm/sceditor@3/minified/formats/bbcode.min.js,npm/sceditor@3/minified/icons/monocons.min.js"></script>

@section('content')

<div class="container-xl p-5">
    <!-- Tab bar navigation-->
    @include('tickets.supports.mwc', ['Active'=>'0'])
        <!-- Divider-->
    <hr class="mt-0 mb-5">
    <!-- Profile content row-->
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des tickets en arrivées</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">type</th>
                        <th scope="col">Inisateur</th>
                        <th scope="col">content</th>
                        <th scope="col">updated_at</th>
                        <th scope="col">created_at</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <th scope="row">{{ $ticket->id }}</th>
                            <td>{{ $ticket->type->name }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>{!! $ticket->content !!}</td>
                            <td>{{\Carbon\Carbon::parse($ticket->updated_at)->format('d/m/Y à H:i')}}</td>
                            <td>{{\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y à H:i')}}</td>
                            <td>
                                <a type="button" class="btn btn-out-primary" href="{{ route("tickets.supports.acquit", $ticket->id) }}"><i class="bi bi-archive-fill"></i></a> 
                                <a type="button" class="btn btn-out-primary" href="{{ route("tickets.supports.view", $ticket->id) }}"><i class="bi bi-eye-fill"></i></a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection