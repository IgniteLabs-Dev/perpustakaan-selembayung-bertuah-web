<html>

<head>
    <x-style/>
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <x-sidebar />
        <div class="flex flex-col flex-1 overflow-y-auto">
            <x-navbar-admin />
            <div class="px-4 pt-12 pb-10 mt-0">
                @yield('content')
            </div>
        </div>

    </div>

<x-script/>

</body>

</html>
