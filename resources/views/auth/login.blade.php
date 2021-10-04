<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="asset/css/login.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Admin | Login</title>
    </head>
    <body>
    <div class="container">
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="frame">
        <div class="nav">
            <ul class="links">
                <li class="signin-active"><a class="btn">Sign in</a></li>
            </ul>
        </div>
        <div ng-app ng-init="checked = false">
            <form class="form-signin"  method="POST" action="{{ route('login-admin') }}">
                @csrf
                <label for="username">Email Address *</label>
                <input class="form-styling @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus autocomplete="off" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="password">Password *</label>
                <input class="form-styling @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required/>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="btn-animate">
                    <button type="submit" class="btn btn-signin text-white">
                        Login
                    </button>
                </div>
                <!-- <div class="row">
                    <div class="col">
                        <a href="{{route('login.google')}}" style="text-decoration:none" class="btn-animate btn-danger">
                            Login With Google
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{route('login.facebook')}}" style="text-decoration:none" class="btn-animate btn-primary">
                            Login With Facebook
                        </a>
                    </div>
                </div> -->
            </form>
        </div>       
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>