<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP2CARS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css"
        crossorigin="anonymous" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header class="bg-dark text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('vehicles') }}">Vehículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('clients') }}">Clientes</a>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('scripts')
</body>

</html>
