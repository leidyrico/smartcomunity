<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ $pageTitle ?? 'Adminty - Premium Admin Template by Colorlib' }}</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $metaDescription ?? '#' }}">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="{{ $metaAuthor ?? '#' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('resources/images/favicon.ico') }}" type="image/x-icon">
    
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom Login CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    
    <!-- Estilos adicionales para mensajes de error -->
    <style>
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        .form-group.has-error .form-control {
            border-color: #dc3545;
        }
        .alert {
            margin-bottom: 20px;
        }
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                    <form class="md-float-material form-material" method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">{{ $loginTitle ?? 'Sign In' }}</h3>
                                    </div>
                                </div>
                                
                                <!-- Mostrar mensajes de sesión de Laravel -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="alert alert-info">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                
                                <!-- Mensaje de alerta dinámico -->
                                <div id="alertMessage" class="alert" style="display: none;"></div>
                                
                                <div class="form-group form-primary @error('email') has-error @enderror" id="emailGroup">
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" 
                                           required 
                                           placeholder="Your Email Address"
                                           autocomplete="email" 
                                           autofocus>
                                    <span class="form-bar"></span>
                                    @error('email')
                                        <div class="error-message" style="display: block;">{{ $message }}</div>
                                    @enderror
                                    <div class="error-message" id="emailError">Por favor ingrese un email válido</div>
                                </div>
                                
                                <div class="form-group form-primary @error('password') has-error @enderror" id="passwordGroup">
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           required 
                                           placeholder="Password"
                                           autocomplete="current-password">
                                    <span class="form-bar"></span>
                                    @error('password')
                                        <div class="error-message" style="display: block;">{{ $message }}</div>
                                    @enderror
                                    <div class="error-message" id="passwordError">La contraseña es requerida</div>
                                </div>
                                
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" 
                                                       name="remember" 
                                                       id="rememberMe" 
                                                       {{ old('remember') ? 'checked' : '' }}>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-right f-w-600">Forgot Password?</a>
                                            @else
                                                <a href="#" class="text-right f-w-600">Forgot Password?</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" id="signInBtn" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                            <span id="btnText">{{ $loginButtonText ?? 'Sign in' }}</span>
                                            <span id="btnSpinner" style="display: none;">
                                                <i class="fa fa-spinner fa-spin"></i> Signing in...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you.</p>
                                        <p class="text-inverse text-left">
                                            <a href="{{ url('/') }}"><b class="f-w-600">Back to website</b></a>
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('images/auth/Logo-small-bottom.png') }}" alt="small-logo.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="{{ asset('images/browser/chrome.png') }}" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="{{ asset('images/browser/firefox.png') }}" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="{{ asset('images/browser/opera.png') }}" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="{{ asset('images/browser/safari.png') }}" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="{{ asset('images/browser/ie.png') }}" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    
    <!-- Required Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js"></script>
    <!-- modernizr js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!-- i18next.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/i18next/21.10.0/i18next.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/i18next-xhr-backend/3.2.2/i18nextXHRBackend.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/i18next-browser-languagedetector/6.1.8/i18nextBrowserLanguageDetector.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-i18next/1.2.1/jquery-i18next.min.js"></script>

    <!-- Script personalizado para el login -->
    <script>
        $(document).ready(function() {
            // Configurar el token CSRF para las peticiones AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Función para mostrar mensajes
            function showMessage(message, type) {
                const alertDiv = $('#alertMessage');
                alertDiv.removeClass('alert-success alert-danger alert-warning');
                alertDiv.addClass('alert-' + type);
                alertDiv.text(message);
                alertDiv.show();
                
                // Auto-ocultar después de 5 segundos
                setTimeout(function() {
                    alertDiv.fadeOut();
                }, 5000);
            }

            // Función para validar email
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Función para limpiar errores
            function clearErrors() {
                $('.form-group').removeClass('has-error');
                $('.error-message').hide();
            }

            // Función para mostrar error en campo específico
            function showFieldError(fieldId, errorId) {
                $('#' + fieldId).addClass('has-error');
                $('#' + errorId).show();
            }

            // Función para manejar el estado de carga del botón
            function setButtonLoading(loading) {
                const btn = $('#signInBtn');
                const btnText = $('#btnText');
                const btnSpinner = $('#btnSpinner');
                
                if (loading) {
                    btn.prop('disabled', true);
                    btnText.hide();
                    btnSpinner.show();
                } else {
                    btn.prop('disabled', false);
                    btnText.show();
                    btnSpinner.hide();
                }
            }

            // Manejar el envío del formulario (si quieres validación adicional en el frontend)
            $('#loginForm').on('submit', function(e) {
                // Si quieres mantener la validación del frontend, descomenta esto:
                /*
                e.preventDefault();
                
                // Limpiar errores previos
                clearErrors();
                $('#alertMessage').hide();
                
                // Obtener valores
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();
                
                let hasErrors = false;
                
                // Validar email
                if (!email) {
                    showFieldError('emailGroup', 'emailError');
                    $('#emailError').text('El email es requerido');
                    hasErrors = true;
                } else if (!isValidEmail(email)) {
                    showFieldError('emailGroup', 'emailError');
                    $('#emailError').text('Por favor ingrese un email válido');
                    hasErrors = true;
                }
                
                // Validar contraseña
                if (!password) {
                    showFieldError('passwordGroup', 'passwordError');
                    hasErrors = true;
                } else if (password.length < 6) {
                    showFieldError('passwordGroup', 'passwordError');
                    $('#passwordError').text('La contraseña debe tener al menos 6 caracteres');
                    hasErrors = true;
                }
                
                // Si hay errores, no continuar
                if (hasErrors) {
                    showMessage('Por favor corrija los errores en el formulario', 'danger');
                    return;
                }
                
                // Si todo está bien, enviar el formulario
                this.submit();
                */
                
                // Mostrar estado de carga cuando se envía el formulario
                setButtonLoading(true);
            });

            // Limpiar errores cuando el usuario empiece a escribir
            $('#email, #password').on('input', function() {
                const fieldId = $(this).closest('.form-group').attr('id');
                $('#' + fieldId).removeClass('has-error');
                $('#' + fieldId + ' .error-message').hide();
            });

            // Auto-ocultar las alertas de Laravel después de 5 segundos
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        });
    </script>

    @if(config('app.env') === 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id', 'UA-23581568-13') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config("services.google_analytics.id", "UA-23581568-13") }}');
        </script>
    @endif
</body>
</html>