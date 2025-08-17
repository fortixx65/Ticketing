@extends('admin.layout')

@section('title', 'Project tickets')

@section('content')
    @include('admin.projects.mwc', ['Active' => '1'])
    <!-- Divider-->
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Info sur les tickets</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <!-- Profile picture image-->
                        <div class="h6 mb-1">Il y a {{ $count }} tickets</div>
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
                            <h2 class="card-title text-white mb-0">Liste des tickets</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">content</th>
                                <th scope="col">type</th>
                                <th scope="col">Temps</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets_project as $ticket)
                                <tr>
                                    <th scope="row">{{ $ticket->id }}</th>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->content }}</td>
                                    <td>{{ $ticket->type->name }}</td>
                                    <td>Null</td>
                                    <td>
                                        <a type="button" class="btn btn-outline-primary" href="{{ route('admin.tickets.action', $ticket) }}"><span class="material-icons small">visibility</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
