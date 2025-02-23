<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50" style="text-align: center;">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                      <h1 >email</h1>
                </div>
                <div>
                <p >{{ $detals['title']}} {{ $detals['body'] }}</p>
            </div>
    </body>
</html>
