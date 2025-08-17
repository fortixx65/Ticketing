@extends('tickets.supports.layout')

@section('title', 'test')

@section('content')
    
    <h1>Projets</h1>
    <div class="container text-center">
        <div class="row row-cols-3">
            @foreach ($projects as $project)
            <div class="col my-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h4>{{$project->content}}</h4>
                    </div>
                    {{-- @if ($project->status === 0)
                        <button type="button" class="btn btn-outline-primary" disabled>Ouvrir</button>
                    @else 
                        <a type="button" class="btn btn-outline-primary" href="{{ route('tickets.supports.news', $project)}}">Ouvrir</a>
                    @endif --}}
                </div>
            </div>    
            @endforeach
        </div>
    </div>

@endsection