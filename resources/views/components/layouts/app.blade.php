<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Data Collection System' }}</title>
    @include('links')
    @include('scripts')
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('topstrip')
        @include('sidebar')

        <div class="body-wrapper">
            @include('topbar')
            <div class="body-wrapper-inner">
                <div class="container-fluid">


                    {{ $slot }}


                </div>
            </div>

        </div>

    </div>

</body>

</html>
