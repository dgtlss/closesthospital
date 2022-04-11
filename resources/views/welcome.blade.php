<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Closest Hospital</title>
        <link rel="shortcut icon" href="/hospital.png" type="image/png">

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="antialiased h-screen bg-slate-900 relative">
        <div class="w-full overflow-hidden bg-red-600 text-center text-white py-2 animate-pulse shadow-sm">
            In the event of an emergency please dial 999 for proper assistance!
        </div>
    <x-closest-hospital/>
    </body>
</html>
