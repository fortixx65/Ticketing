@extends('tickets.supports.elements.layout')

@section('title', 'test')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/combine/npm/sceditor@3/minified/sceditor.min.js,npm/sceditor@3/minified/formats/bbcode.min.js,npm/sceditor@3/minified/icons/monocons.min.js"></script>

@section('content')
    
<div class="hero-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="left-content">
            <div class="content">
              <h1 class="title">
              <span style="color:#FF951B;">Ticket n°{{ $ticket->count }}, {{ $ticket->type->name }}</span>
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<section class="faq-section" style="padding: 50px 0px 120px;">
    <div class="container content">
        <div class="row mb-2">
            <div class="col-md-9">
            </div>
  
            <div class="col-md-3 d-flex align-items-center justify-content-md-end">
                <div>
                    @if(Auth::user())
                          {{-- <form action="" method="POST" class="d-inline-block">
                              @csrf
  
                              <button class="btn btn-success btn-sm @if($discussion->is_pinned) active @endif" title="@if($discussion->is_pinned) Épinglé @else Désépingler @endif" data-toggle="tooltip">
                                  <i class="fas fa-thumbtack fa-fw"></i>
                              </button>
                          </form>
  
                          <form action="" method="POST" class="d-inline-block">
                              @csrf
  
                              <button class="btn btn-secondary btn-sm @if($discussion->is_locked) active @endif" title="{{ trans('forum::messages.actions.'.($discussion->is_locked ? 'unlock' : 'lock')) }}" data-toggle="tooltip">
                                  <i class="fas fa-lock{{ $discussion->is_locked ? '-open' : ''}} fa-fw"></i>
                              </button>
                          </form>
  
  
                          <a href="" class="btn btn-info btn-sm" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip">
                              <i class="fas fa-edit fa-fw"></i>
                          </a>
  
                          <form action="" method="POST" class="d-inline-block" onsubmit="return confirm('{{ trans('forum::messages.discussions.delete') }}')">
                              @csrf
  
                              <button type="submit" class="btn btn-danger btn-sm" title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip">
                                  <i class="fas fa-trash fa-fw"></i>
                              </button>
                          </form> --}}
                      @else
                          <a href="" class="btn btn-info btn-sm" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip">
                              <i class="fas fa-edit fa-fw"></i>
                          </a>
                      @endif
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header text-right">
                <div class="row">
                    <div class="col-1">
                        
                    </div> 
                    <div class="col-3">
                        <small>{{\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y à H:i')}}</small>
                    </div>
                    <div class="col-3">
                        {{ $ticket->user_id }}
                    </div>
                </div>      
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-10 col-md-9">
                        <div class="mb-3">
                            <small>{{\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y à H:i')}}</small>
                        </div>
                        <div class="mb-3">
                            {!! $ticket->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header text-right">
                        <div class="row">
                            <div class="col-1">
                                {{ $post->count }}
                            </div> 
                            <div class="col-3">
                                <small>{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y à H:i')}}</small>
                            </div>
                            <div class="col-3">
                                {{ $post->user_id }}
                            </div>
                        </div>      
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-10 col-md-9"> 
                                <div class="mb-3">
                                    {!! $post->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach  
    </div>
    <div class="card-end">
        <div class="flex flex-row" style="position:fixed; bottom:3%; right:30%; z-index:9999;">
            {{-- <button type="submit" class="btn btn-primary">
                <i class="fas fa-reply"></i>
                Ajouter
            </button> --}}
            <a type="button" class="btn btn-outline-primary justify-content-md-end" data-bs-toggle="modal" data-bs-target="#modalAdd" class="mx-1" title="Modifier" data-toggle="tooltip" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;">Ajouter un commentaire</i></a>
            <a type="button"  class="btn btn-danger" href="" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;">Enregistrer</a>
            <a type="button"  class="btn btn-primary" href="" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;">Enregistrer et quitter</a>
        </div>
    </div>
</section>

<!-- Modal Create-->
<div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <form method="post" action="{{ route("tickets.supports.message_Add", $ticket) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ajouter un commentaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" required></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="type">
                            <option name="all" value="1" selected="">ALL</option>
                            <option name="interne" value="2" selected="">interne</option>
                            <option name="Others" value="3" selected="">Others</option>
                        </select>
                        <label for="floatingInput">Type de commentaire</label>
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