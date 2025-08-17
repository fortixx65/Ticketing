@extends('admin.layout')

@section('title', 'User logs')

@section('content')
    @include('admin.users.mwc', ['Active' => '1'])
    <hr class="mt-0 mb-5">
    <div class="card card-raised mb-5">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Logs</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">Action effectuée</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td scope="row">{{ $log->action }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
