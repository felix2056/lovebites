<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') - LoveBites</title>

    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="@yield('title') - LoveBites">
    <meta name="author" content="felix-codebreaker">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/logo/lovebites-favicon.png">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:200,300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function (d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    
    @yield('styles')
</head>

<body>
    <div class="page-wrapper">
        @yield('content')

    </div>
    <!-- End .page-wrapper -->

    <!-- Extra JS Includes -->
    @yield('scripts')

    <script src="https://widget.flowxo.com/embed.js" data-fxo-widget="eyJ0aGVtZSI6IiNlNTQxODkiLCJ3ZWIiOnsiYm90SWQiOiI2Mzg5MThmZTI4NWYzZjMzMmE1YjBhYzciLCJ0aGVtZSI6IiNlNTQxODkifSwid2VsY29tZVRleHQiOiJXZWxjb21lLiBIb3cgY2FuIHdlIGhlbHA/IPCfmIAifQ==" async defer></script>
</body>

</html>