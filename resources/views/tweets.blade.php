<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Twitter component - settings</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="antialiased">
<div class="container">
    <h1 class="my-3">{{ trans('app.tweets.title') }}</h1>

    <div class="row">
        <div class="col-6">
            <form method="GET">
                <label for="search" class="form-label">{{ trans('app.tweets.search') }}</label>
                <input type="text" name="search" class="form-control" id="search" value="">
                <button type="submit" class="btn btn-primary my-2">{{ trans('app.search') }}</button>
            </form>
        </div>
        <div class="col-6">
            <h3>{{ trans('app.activePhrases') }}</h3>
            <div class="container p-0">
                <div class="row row-cols-auto">
            @foreach($phrases as $phrase)
                <form method="GET" class="col">
                    <input type="hidden" value="{{ $phrase }}" name="remove" />
                    <button type="submit" class="btn btn-danger">{{ $phrase }}</button>
                </form>
            @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($tweets as $tweet)
            <div class="col-5 my-3">
                <div class="card">
                    <div class="card-header">
                        {{ $tweet->author->name }} <small>{{ '@'.$tweet->author->username }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! $tweet->text !!}</p>
                    </div>
                    <div class="card-body">
                        <a href="https://twitter.com/{{ $tweet->author->username }}/status/{{ $tweet->id }}"
                           class="card-link"
                           target="_blank">
                            Show tweet
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
