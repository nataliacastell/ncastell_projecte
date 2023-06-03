<!DOCTYPE html>
<head>
<link href="/css/app.css" rel="stylesheet">
<link href="/js/app.js" rel="javascript">

</head>
<body>
    @section('sidebar')
    <!--sacar esto de aqui solo para ves si se aplica todo-->
    <div class="sidebar">
        <!-- Header -->
        <header class="py-4 px-6 bg-gray-900 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ url('img/logo.png') }}"  alt="Logo" class="h-8 w-8">
                <span class="text-white ml-2 text-lg font-semibold">My App</span>
            </div>

            <!-- Navigation -->
            <nav class="mt-4">
                <ul class="flex space-x-4 px-4 py-2">
                    <!-- Mis Post -->
                    <li class="px-4 py-2 mx-2 my-2 m-1">
                        <a href="/mis-post" class="flex items-center text-gray-300 hover:text-white">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M19 4a1 1 0 00-1-1h-1.3a1 1 0 00-.71.29L13 7.59l-2-2L5.71 9.29a1 1 0 00-1.42 1.42L9 14.41l2 2L12.41 15l3.71-3.71A1 1 0 0019 10V4zM7 9a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2">Mis Post</span>
                        </a>
                    </li>

                    <!-- Post Seguidos -->
                    <li class="px-4 py-2 mx-2 my-2 m-1">
                        <a href="/post-seguidos" class="flex items-center text-gray-300 hover:text-white">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M17 9a5 5 0 01-7.74 4.14l-1.4 1.65a1 1 0 01-1.52 0l-1.4-1.65A5 5 0 013 9V8a5 5 0 016-4.9V3a1 1 0 112 0v.1A5 5 0 0117 8v1zM8 5a3 3 0 00-3 3v1h6V8a3 3 0 00-3-3zm9 2a3 3 0 00-3-3h-.1A5 5 0 0012 3V2a1 1 0 112 0v1a5 5 0 004.9 4H17zm-1 4a3 3 0 00-2.82 2H5.82A3 3 0 003 13v3a3 3 0 003 3h8a3 3 0 003-3v-3zM6 15a1 1 0 100 2h2a1 1 0 100-2H6zm6 0a1 1 0 100 2h2a1 1 0 100-2h-2z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2">Post Seguidos</span>
                        </a>
                    </li>

                    <!-- Post no Seguidos -->
                    <li class="px-4 py-2 mx-2 my-2 m-1 ">
                        <a href="/post-no-seguidos" class="flex items-center text-gray-300 hover:text-white">
                            <svg class="h-4 w-4 fill-current " viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M4 6a1 1 0 011-1h6.586l-1.293-1.293a1 1 0 010-1.414 1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L11.586 7H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2">Post no Seguidos</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Resto del contenido del sidebar -->
        <!-- ... -->
    </div>
    @show

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
