<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title')</title>

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1f1e1e;
            color: #e0e0e0;
            padding-bottom: 80px;
        }

        /* Header */
        h1 {
            background: linear-gradient(90deg, #1a1a1a, #2c2c2c);
            color: #ffffff;
            padding: 25px;
            text-align: center;
            letter-spacing: 2px;
            border-bottom: 3px solid #444;
            text-transform: uppercase;
        }

        /* Content Section */
        .content {
            width: 85%;
            margin: 40px auto;
            padding: 40px;
            background: #1c1c1c;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.05);
            border: 1px solid #333;
        }

        /* Footer */
        h5 {
            background: #1a1a1a;
            color: #aaa;
            text-align: center;
            padding: 15px;
            border-top: 2px solid #444;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Hover Effects */
        h1:hover {
            background: linear-gradient(90deg, #2c2c2c, #3a3a3a);
            transition: 0.3s ease;
        }

        .content:hover {
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.08);
            transition: 0.3s ease;
        }

        .page-link {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 16px;
            background: #04AA6D;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
        }

        .page-link:hover {
            background: #038f5c;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333333;
        }

        ul li {
            float: left;
        }

        ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul li a:hover:not(.active) {
            background-color: #111111;
        }

        ul li a.active {
            background-color: #04AA6D;
        }

        .alert {
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background: rgba(4, 170, 109, 0.15);
            border: 1px solid #04AA6D;
            color: #9ff0cb;
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid #dc3545;
            color: #ffb8c0;
        }

        .alert-error ul {
            background: transparent;
            list-style-type: disc;
            padding-left: 20px;
            overflow: visible;
        }

        .alert-error li {
            float: none;
            margin-left: 18px;
        }

        form {
            max-width: 520px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 14px;
            border-radius: 8px;
            border: 1px solid #555;
            background: #2a2a2a;
            color: #fff;
        }

        input[type="submit"],
        button {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            background: #04AA6D;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background: #038f5c;
        }

        .submit-like-link {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            background: #04AA6D;
            color: white;
            text-decoration: none;
            margin-left: 8px;
        }

        .submit-like-link:hover {
            background: #038f5c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #3a3a3a;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #2a2a2a;
        }

        td a {
            color: #7ee7bf;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .action-form {
            display: inline;
        }

        .details-line {
            margin-bottom: 10px;
        }

        .nav-right {
            float: right;
        }

        .nav-form {
            display: block;
            max-width: none;
        }

        .nav-button {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            background: transparent;
            border: 0;
            border-radius: 0;
            cursor: pointer;
            font: inherit;
        }

        .nav-button:hover {
            background-color: #111111;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .panel {
            padding: 18px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #242424;
        }

        .panel h3 {
            margin-bottom: 8px;
        }

        .section-title {
            margin-top: 32px;
            margin-bottom: 8px;
        }

        .student-list-panel {
            margin-top: 32px;
        }

        .record-list-panel {
            margin-top: 32px;
        }
    </style>
</head>
<body>

    <ul>
        @auth
            <li><a href="{{ route('profile') }}">Profile</a></li>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('aboutUs') }}">AboutUs</a></li>
            @if(auth()->user()->role === 'admin')
                <li><a href="{{ url('/students') }}">Students</a></li>
                <li><a href="{{ url('/degrees') }}">Degrees</a></li>
                <li><a href="{{ route('admin.teachers.index') }}">Teachers</a></li>
            @endif
            <li class="nav-right">
                <form class="nav-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-button" type="submit">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>

    <!-- Header -->
    @section('Header')
        <h1>Welcome to my Page</h1> 
    @show

    <!-- Body -->
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('Content')
    </div>

    <!-- Footer -->
    @section('Footer')
        <h5>Copyright @2026 | Bengzz | Benedict Zacarias</h5>
    @show

    <script>
        window.addEventListener('pageshow', function (event) {
            var navigation = performance.getEntriesByType('navigation')[0];

            if (event.persisted || (navigation && navigation.type === 'back_forward')) {
                window.location.reload();
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
    
</body>
</html>
