<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>
            {{ config('app.name') }}
            |
            @yield('pageTitle')
        </title>

        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <style>
            ::-webkit-scrollbar {
                    width: 8px;
                    }
                    /* Track */
                    ::-webkit-scrollbar-track {
                    background: #f1f1f1;
                    }

                    /* Handle */
                    ::-webkit-scrollbar-thumb {
                    background: #888;
                    }

                    /* Handle on hover */
                    ::-webkit-scrollbar-thumb:hover {
                    background: #555;
                    } url('https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap');

            body{

            background-color: #eee;
            }

            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #495057;
            background-color: transparent;
            border-color: transparent;
            border-bottom: 3px solid #000;

            }

            .nav-tabs>li>a{

            text-transform: uppercase;
            color: #000;
            font-weight: 500;
            }

            .nav-tabs .nav-link:hover {
            border-color: transparent;
            border-bottom: 3px solid #000
            }

            .navbar{

            border-bottom: 1px solid #00000012;
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
            background-color: #ffffff!important;
            }

            .navbar-brand{

            font-size: 24px;
            text-transform: uppercase;
            font-family: 'Allerta Stencil', sans-serif;
            font-weight: 500;
            }

            .nav-tabs {
            border-bottom: none;
            }

            .card{

            border:none;

            }

            .card-body {
            flex: 1 1 auto;
            padding: 10px;
            }

            .card-text{

            font-size: 13px;
            }

            .guarantee{

            color: #05882c;
            margin-left: 4px;
            font-weight: 700

            }

            hr{
            margin: 0.2rem 0;
            color: #bfbebe;
            }

            .buttons button{

            text-transform: uppercase;
            font-size: 12px;
            border-radius: 2px;
            }

            img.card-img-top {
                max-height: 300px;
            }
            button.disabled, .btn.disabled {pointer-events: all; cursor: not-allowed!important;}
        </style>
    </head>
    <body>
        {{-- header --}}
        <div class="container-fluid px-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed">
                <div class="container-fluid d-flex"> <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach (\App\Models\Category::getLists() as $category)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $category->name == $currentCategory ? 'active' : '' }}"
                                    href="{{ route('category.items', $category->slug) }}"
                                    >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
        {{-- header end --}}

        <div class="container mt-5 mb-5">
            {{-- content here --}}
            @yield('content')
        </div>

    </body>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>

    @stack('scripts')
</html>
