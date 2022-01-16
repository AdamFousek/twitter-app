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
    <h1 class="my-3">Twitter app - settings</h1>
    @foreach($settings as $setting)
        <form method="POST" action="{{ route('settings.update', $setting) }}">
            @csrf
            <div class="row my-3 align-items-center">
                <div class="col-4">
                    <label for="{{ $setting->key }}" class="form-label">{{ trans('app.'.$setting->key) }}</label>
                </div>
                <div class="col-5">
                    <input type="text" name="setting_value" class="form-control" id="{{ $setting->key }}" value="{{ $setting->value }}">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
                </div>
            </div>
        </form>
    @endforeach
</div>
</body>
</html>
