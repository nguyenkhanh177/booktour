<!DOCTYPE html>
<html lang="en">


<head>
    @yield('title', 'Trang chủ')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/img/favicon.ico') }}">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors.css') }}" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}" />
</head>

<body>
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    <div class="app-main" id="main">
        @yield('content')
    </div>
    @include('admin.partials.footer')
    <!-- plugins -->
    <script src="{{ asset('backend/assets/js/vendors.js') }}"></script>

    <!-- custom app -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
</body>

</html>