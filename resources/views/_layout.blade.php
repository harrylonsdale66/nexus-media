<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/nexaris.css')
    @vite('resources/css/datatable.css')
</head>
<body>
<div id="app-page">
    <div id="app-content">
        <div class="page-layout">
            <div class="page-layout-content">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
