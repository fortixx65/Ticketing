@extends('admin.layout')

@section('title', 'Ticket messages')

@section('content')
    @include('admin.tickets.mwc', ['Active' => '1'])
    <!-- Divider-->
    <hr class="mt-0 mb-5">
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Info des levels</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <!-- Profile picture image-->
                        <div class="h6 mb-1">Il y a {{ $count }} messages</div>
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
                            <h2 class="card-title text-white mb-0">Liste des messages</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Contenu</th>
                                <th scope="col">Envoyer par</th>
                                <th scope="col">Temps</th>
                                <th scope="col">Envoyer le</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>{{ $ticket->content }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>Null</td>
                                <td>{{ $ticket->created_at }}</td>
                            </tr>
                            @foreach ($messages as $message)
                                <tr>
                                    <td scope="row">{{ $message->count }}</td>
                                    <td>{!! $message->content !!}</td>
                                    <td>{{ $message->user->name }}</td>
                                    <td>{{ $message->time() }}</td>
                                    <td>{{ $message->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
