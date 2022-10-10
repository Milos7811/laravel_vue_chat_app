@php
    $authCheck = auth()->check() ? 1 : 0;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VueChat</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div id="app"></div>

        <script>

            let config = {
                authCheck: {{ $authCheck }},

                // Broadcasting
                broadcasting : '{{ config('broadcasting.connections.pusher.driver') }}',
                broadcastingKey : '{{ config('broadcasting.connections.pusher.key') }}',
                broadcastingCluster : '{{ config('broadcasting.connections.pusher.options.cluster') }}',
                broadcastingHost : '{{ config('broadcasting.connections.pusher.options.host') }}',
                broadcastingPort : '{{ config('broadcasting.connections.pusher.options.port') }}'

            }

        </script>

        <script src="{{ mix('js/main.js') }}"></script>
    </body>

