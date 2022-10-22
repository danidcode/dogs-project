<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    @include('global-links')
    @vite(['resources/css/app.css','resources/scss/main.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="app"><AppComponent> </AppComponent></div>

    @include('global-scripts')
</body>
</html>