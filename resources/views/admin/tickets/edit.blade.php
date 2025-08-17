@extends('admin.layout')

@section('title', 'Ticket edit')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/combine/npm/sceditor@3/minified/sceditor.min.js,npm/sceditor@3/minified/formats/bbcode.min.js,npm/sceditor@3/minified/icons/monocons.min.js"></script>
@endsection

@section('content')
    @include('admin.tickets.mwc', ['Active' => '3'])
    <hr class="mt-0 mb-5">
    <!-- Profile content row-->
    <div class="row gx-5">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card card-raised mb-5">
                <div class="card-header bg-primary text-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-4">
                            <h2 class="card-title text-white mb-0">Parametre du ticket</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if ($ticket->status == '2')
                        <div class="text-center">
                            <div class="card-title">Réouvrir le ticket</div>
                            <br>
                            <div class="card-subtitle mb-4">Une fois réouvert, le ticket pourra de nouveau etre assecible !</div>
                            <a href="{{ route('admin.tickets.open', $ticket) }}" class="btn btn-success mdc-ripple-upgraded" type="button">Réactiver</a>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="card-title">Clore le ticket</div>
                            <br>
                            <div class="card-subtitle mb-4">Une fois clos, le ticket ne pourra plus etre assecible !</div>
                            <a href="{{ route('admin.tickets.close', $ticket) }}" class="btn btn-danger mdc-ripple-upgraded" type="button">Désactiver</a>
                        </div>
                    @endif
                    <hr class="my-5">
                    <div class="text-center">
                        <div class="card-title">Supprimer le ticket</div>
                        <br>
                        <div class="card-subtitle mb-4">Une fois supprimé, le ticket sera définitivement supprimé !</div>
                        <a type="button" class="btn btn-danger mdc-ripple-upgraded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $ticket->id }}" class="mx-1" title="Modifier" data-toggle="tooltip">Supprimer</a>
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
                            <h2 class="card-title text-white mb-0">Modification du ticket</h2>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.tickets.editer', $ticket) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit le ticket créé par {{ $ticket->user->name }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="project">
                                    @foreach ($projects as $project)
                                        @if ($project->id == $ticket->project_id)
                                            <option name="{{ $project->name }}" value="{{ $project->id }}" selected>{{ $project->name }}</option>
                                        @else
                                            <option name="{{ $project->name }}" value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingInput">Projet associé</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="type">
                                    @foreach ($types as $type)
                                        @if ($type->id == $ticket->type_id)
                                            <option name="{{ $type->name }}" value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                        @else
                                            <option name="{{ $type->name }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingInput">Type de ticket</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="priority">
                                    @foreach ($priority as $prty)
                                        @if ($prty->id == $ticket->priority_id)
                                            <option name="{{ $prty->name }}" value="{{ $prty->id }}" selected>{{ $prty->name }}</option>
                                        @else
                                            <option name="{{ $prty->name }}" value="{{ $prty->id }}">{{ $prty->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="floatingInput">Priorité du ticket</label>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content"></label>
                                <textarea class="form-control" id="markdown" name="content" rows="4">{{ $ticket->content }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mdc-ripple-upgraded">Sauvegarder les modifications</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete{{ $ticket->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal">Supprimer le ticket n°{{ $ticket->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>Confirmer la suppression du ticket créé par {{ $ticket->user->name }}</div>
                    <div>Il supprimera tous les messages associés à ce ticket</div>
                    <div>Ainsi que tous les temps associés à ce ticket</div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-text-danger" href="{{ route('admin.tickets.delete', $ticket->id) }}">Supprimer</a>
                </div>
            </div>
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
