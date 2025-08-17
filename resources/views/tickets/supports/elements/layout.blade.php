<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Load Favicon-->
    <link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <!-- Load Material Icons from Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <!-- Load Simple DataTables Stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <!-- Roboto and Roboto Mono fonts from Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet">
    <!-- Load main stylesheet-->
    <link href={{asset("css/admin/styles.css")}} rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
     
    <title>@yield('title')</title>
</head>
<body class="nav-fixed bg-light">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    @if(session()->has('error'))
        <script>
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top',
                },
            });
            notyf.error('{{ session()->get("error") }}');
        </script>
        @endif
        @if(session()->has('success'))
            <script>
                const notyf = new Notyf({
                    duration: 3000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });
                notyf.success('{{ session()->get("success") }}');
            </script>
        @endif
        @include('tickets.supports.elements.navbar')
        <div id="layoutDrawer">
            <!-- Layout content-->
            <div id="layoutDrawer_content">
                <!-- Main page content-->
                <main>
                    <!-- Main dashboard content-->
                    <div class="container-xl p-5">
                        @yield('content')  
                    </div>
                </main>
                @include('tickets.supports.elements.footer')
            </div>
            
        </div>
       
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Load Bootstrap JS bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Load global scripts-->
    <script type="module" src={{asset("js/admin/material.js")}}></script>
    <script src={{asset("js/admin/scripts.js")}}></script>
    <!--  Load Chart.js via CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js" crossorigin="anonymous"></script>
    <!--  Load Chart.js customized defaults-->
    <script src={{asset("js/admin/charts/chart-defaults.js")}}></script>
    <!--  Load chart demos for this page-->
    <script src={{asset("js/admin/charts/demos/chart-pie-demo.js")}}></script>
    <script src={{asset("js/admin/charts/demos/dashboard-chart-bar-grouped-demo.js")}}></script>
    <!-- Load Simple DataTables Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@6.0.8" type="text/javascript"></script>
    <script src="{{ asset('js/admin/datatables/datatables-simple-demo.js') }}"></script>
    
</body>
</html>