<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50" style="text-align: center;">
        <h1>Add Offer</h1>
        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        <form method="post" action="{{ route('store_offer') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">name offer</label>
                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter Name Offer">
                @error('name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">price</label>
                <input type="text" class="form-control" name="price" placeholder="price">
                @error('price')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">details</label>
                <input type="text" class="form-control" name="details" placeholder="details">
                @error('details')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>
