<!DOCTYPE html>
<html lang="en">
    <head>
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
