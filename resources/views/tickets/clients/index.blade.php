@extends('tickets.supports.elements.layout')

@section('title', 'Mes tickets')

@section('content')
<div class="card card-raised">
    <div class="card-header bg-primary text-white px-4">
        <h2 class="card-title text-white mb-0">Mes tickets</h2>
    </div>
    <div class="card-body p-4">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Projet</th>
                    <th>Statut</th>
                    <th>Mise à jour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->type->name }}</td>
                    <td>{{ $ticket->project->content }}</td>
                    <td>{{ $ticket->status() }}</td>
                    <td>{{ \Carbon\Carbon::parse($ticket->updated_at)->format('d/m/Y à H:i') }}</td>
                    <td>
                        <a class="btn btn-outline-primary" href="{{ route('tickets.supports.view', $ticket->id) }}">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

