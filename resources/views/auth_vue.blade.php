<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TuneVerse Auth</title>
    @vite('resources/css/app.css')
    </head>
<body>
    <div id="auth-app">
        </div>
    @vite(['resources/css/app.css', 'resources/js/auth_vue.js'])
</body>
</html>
