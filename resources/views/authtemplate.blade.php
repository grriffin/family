<!DOCTYPE html>
<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="../css/app.css">
    </head>
    <body>
        @section('sidebar')
            
        @show

        <div class="container">
            <div class="row navigation">
              <div>

              </div>
              <div>
                <a class="btn btn-primary" href="/auth/login">Login</a>
                <a class="btn btn-primary" href="/auth/register">Sign Up</a>
              </div>
            </div>
            @yield('content')
        </div>
    </body>
</html>