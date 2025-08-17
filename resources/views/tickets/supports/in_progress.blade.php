@extends('tickets.supports.elements.layout')

@section('title', 'Project')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/combine/npm/sceditor@3/minified/sceditor.min.js,npm/sceditor@3/minified/formats/bbcode.min.js,npm/sceditor@3/minified/icons/monocons.min.js"></script>

@section('content')

<div class="container-xl p-5">
    <!-- Tab bar navigation-->
    @include('tickets.supports.mwc', ['Active'=>'1'])
        <!-- Divider-->
    <hr class="mt-0 mb-5">
    <!-- Profile content row-->
    <div class="card card-raised">
        <div class="card-header bg-primary text-white px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-4">
                    <h2 class="card-title text-white mb-0">Liste des items</h2>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">action</th>
                        <th scope="col">user_id</th>
                        <th scope="col">content</th>
                        <th scope="col">status</th>
                        <th scope="col">updated_at</th>
                        <th scope="col">created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->type === 1)
                            @if($ticket->status === 1)
                                <tr>
                                    <th scope="row">{{ $ticket->id }}</th>
                                    <td>
                                        <a type="button" class="btn btn-outline-primary" href="{{ route("tickets.supports.ticket_Open", $ticket->id) }}"><i class="bi bi-eye-fill"></i></a>
                                    </td>
                                    <td>{{ $ticket->user_id }}</td>
                                    <td>{!! $ticket->content !!}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{\Carbon\Carbon::parse($ticket->updated_at)->format('d/m/Y à H:i')}}</td>
                                    <td>{{\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y à H:i')}}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
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