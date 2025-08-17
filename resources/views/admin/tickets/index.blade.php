@extends('admin.layout')

@section('title', 'Tickets')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/combine/npm/sceditor@3/minified/sceditor.min.js,npm/sceditor@3/minified/formats/bbcode.min.js,npm/sceditor@3/minified/icons/monocons.min.js"></script>
@endsection

@section('content')
    <div class="card card-raised">
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
                        <th scope="col">Initiateur</th>
                        <th scope="col">Projet</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Priorité</th>
                        <th scope="col">Temps</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td scope="row">{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>{{ $ticket->project->name }}</td>
                            <td>{!! $ticket->content !!}</td>
                            <td>{{ $ticket->type->name }}</td>
                            <td>{{ $ticket->priority->name }}</td>
                            <td>ERROR</td>
                            <td>{{ $ticket->status() }}</td>

                            <td>
                                <a type="button" class="btn btn-outline-primary" href="{{ route('admin.tickets.action', $ticket) }}"><span class="material-icons small">visibility</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end py-3">
                <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalCreate" class="mx-1" title="Modifier" data-toggle="tooltip">Créer un ticket</i></a>
            </div>
        </div>
    </div>
    <!-- Modal Create-->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <form method="post" action="{{ route('admin.tickets.create') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="project">
                                @foreach ($projects as $project)
                                    <option name="{{ $project->name }}" value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">Projet associé</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="type">
                                @foreach ($types as $type)
                                    <option name="{{ $type->name }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">Type de ticket</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="priority">
                                @foreach ($priority as $prty)
                                    <option name="{{ $prty->name }}" value="{{ $prty->id }}">{{ $prty->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">Priorité du ticket</label>
                        </div>
                        <div class="form-group mb-3">
                            <label for="content"></label>
                            <textarea class="form-control" id="markdown" name="content" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-text-primary mdc-ripple-upgraded" type="submit">Créer le projet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
    <script>
        // Replace the textarea #example with SCEditor
        sceditor.create(document.getElementById('markdown'), {
            format: 'xhtml',
            width: '100%',
            height: '100%',
            locale: 'fr',
            emoticonsEnabled: true,
            emoticons: {
                dropdown: {
                    ':onoria:': 'http://leowors.fr/onoriav2/img/onoria-300x300.png',
                },
            },
            toolbar: 'bold,italic,underline|left,center,right,justify|font,size,color|youtube,image,link,unlink|emoticon',
            icons: 'monocons',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css'
        });
    </script>
@endsection
