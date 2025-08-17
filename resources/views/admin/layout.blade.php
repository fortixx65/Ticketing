<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Load Favicon-->
    <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <!-- Load Material Icons from Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"rel="stylesheet">
    <!-- Load Simple DataTables Stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <!-- Roboto and Roboto Mono fonts from Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet">
    <!-- Load main stylesheet-->
    <link href={{ asset('css/admin/styles.css') }} rel="stylesheet">

    @yield('css')

    <title>@yield('title')</title>
</head>

<body class="nav-fixed bg-light">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    @if (session()->has('error'))
        <script>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                },
            });
            notyf.error('{{ session()->get('error') }}');
        </script>
    @endif
    @if (session()->has('warning'))
        <script>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                },
                types: [{
                    type: 'warning',
                    background: 'orange',
                    icon: {
                        className: 'material-icons',
                        tagName: 'i',
                        text: 'warning',
                        color: 'white',
                    }
                }],
            });
            notyf.open({
                type: 'warning',
                message: '{{ session()->get('warning') }}'
            });
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                },
            });
            notyf.success('{{ session()->get('success') }}');
        </script>
    @endif
    @include('admin.elements.navbar')
    <div id="layoutDrawer">
        <!-- Layout navigation-->
        @include('admin.elements.sidebar')
        <!-- Layout content-->
        <div id="layoutDrawer_content">
            <!-- Main page content-->
            <main>
                <!-- Main dashboard content-->
                <div class="container-xl p-5">
                    @yield('content')
                </div>
            </main>
            @include('admin.elements.footer')
        </div>
    </div>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Load Bootstrap JS bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Load global scripts-->
    <script type="module" src={{ asset('js/admin/material.js') }}></script>
    <script src={{ asset('js/admin/scripts.js') }}></script>
    <!--  Load Chart.js via CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js" crossorigin="anonymous"></script>
    <!--  Load Chart.js customized defaults-->
    <script src={{ asset('js/admin/charts/chart-defaults.js') }}></script>
    <!--  Load chart demos for this page-->
    <script src={{ asset('js/admin/charts/demos/chart-pie-demo.js') }}></script>
    <script src={{ asset('js/admin/charts/demos/dashboard-chart-bar-grouped-demo.js') }}></script>
    <!-- Load Simple DataTables Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@6.0.8" type="text/javascript"></script>
    <script src="{{ asset('js/admin/datatables/datatables-simple-demo.js') }}"></script>

</body>

</html>
