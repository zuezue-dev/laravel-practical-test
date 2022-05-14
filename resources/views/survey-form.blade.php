<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
   
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Padauk&family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Padauk', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="card w-50 mx-auto">
            <div class="card-header bg-white p-3">
                <h2 class="mb-0">{{ $survey->name }}</h2>
            </div>
            <form action="{{ route('answer.store', [$survey]) }}" method="post">
                @foreach($survey->questions()->get() as $question)
                <div class="p-3">
                    @include(view()->exists("types.{$question->type}") 
                        ? "types.{$question->type}" 
                        : "types.text",[
                            'disabled' => false, 
                            'value' => null,
                            'includeResults' => null
                        ]
                    )
                </div>
                @endforeach
                
                <div class="p-3">
                    <button class="btn btn-primary form-control">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>