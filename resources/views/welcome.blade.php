<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agri-Higala</title>

    <!-- Custom styles from scss-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent pt-2">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link h5 mr-1 active" href="/">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link h5 mr-1" href="/buyer/browse">Browse</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link h5 ml-1" href="{{ route('login') }}">Login</a>
                    <a class="nav-item nav-link h5 ml-1" href="{{ route('register') }}">Sign-up</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="agri-logo mt-5 pt-5">
                        <img src="/images/Logo.png" alt="agri-logo">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="agri-brand">
                        <img src="/images/agrihigala_word.png" alt="agri-brand">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="agri-title">
                        <span class="text-uppercase">Produktong lokal para sa katawhan</span>
                    </div>
                </div>
            </div>
            <div class="row pb-5">
                <div class="agri-subtitle shadow"> 
                    <p class="mt-3">
                        <i class="fa fa-quote-left mb-2"></i> Connecting farmers <br> and the <br> community <i class="fa fa-quote-right mb-2"></i>
                    </p>
                </div>
            </div>  
            <div class="welcome-footer">
                <div class="row text-white mt-5">
                    <div class="col-md-4 text-center">
                        {{-- <img src="/images/cdo_agri.jpg" alt="cdo aghrihigala logo"> --}}
                        <p>
                            Cagayan de Oro
                            <br>
                            City Agriculture Office
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        {{-- <img src="/images/ustp.png" alt="ustp logo"> --}}
                        <p>
                            University Of Science and 
                            <br> 
                            Technology of Southern Philippines
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        {{-- <img src="/images/CITC_logo.png" alt="citc logo"> --}}
                        <p>
                            USTP-College of Information
                            <br>
                            Technology & Computing
                        </p>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
    {{-- <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script> --}}

    @stack('scripts')

    <script>
        setTimeout(function(){
        $('.alert').slideUp();
        },4000);
    </script> 
</body>
</html>
