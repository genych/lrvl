<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Personal Hackernews feed</title>
    </head>
    <body>
        @guest
            <form method="post" action="/api/login">
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" required/>
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password"/>
                </div>
                <div>
                    <input type="submit" value="Login"/>
                </div>
            </form>
        @endguest
    </body>
</html>
