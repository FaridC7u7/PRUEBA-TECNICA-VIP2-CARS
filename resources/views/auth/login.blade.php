<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VIP2CARS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h1 class="h3 font-weight-bold">Iniciar Sesión</h1>
            <p class="text-muted mb-0">Accede a la gestión de VIP2CARS</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}">

            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required autocomplete="username" autofocus
                    class="form-control" placeholder="Ingresa tu usuario" />
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    class="form-control" placeholder="Ingresa tu contraseña" />
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember" />
                <label class="form-check-label" for="remember_me">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                Iniciar Sesión
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
