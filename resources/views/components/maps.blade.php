<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Agregar estilos para la vista de dispositivos pequeños */
        @media (max-width: 768px) {
            .flex-wrap {
                display: flex;
                flex-wrap: wrap;
            }
            .section-small {
                width: 50%;
            }
        }
    </style>
</head>
<body>
<div class="flex flex-col h-screen bg-gray-100">

    <!-- Barra de navegación superior -->
    <div class="bg-white text-white shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center">
            <div class="hidden md:flex items-center"> <!-- Se oculta en dispositivos pequeños -->
                <img src="https://www.emprenderconactitud.com/img/POC%20WCS%20(1).png" alt="Logo" class="w-28 h-18 mr-2">
                <h2 class="font-bold text-xl">Dashboard</h2>
            </div>
            <div class="md:hidden flex items-center"> <!-- Se muestra solo en dispositivos pequeños -->
                <button id="menuBtn">
                    <i class="fas fa-bars text-gray-500 text-lg"></i> <!-- Ícono de menú -->
                </button>
            </div>
        </div>

        <!-- Ícono de Notificación y Perfil -->
        <div class="space-x-5">
            <button>
                <i class="fas fa-bell text-gray-500 text-lg"></i>
            </button>
            <!-- Botón de Perfil -->
            <button>
                <i class="fas fa-user text-gray-500 text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 flex">
        <!-- Barra lateral de navegación (oculta en dispositivos pequeños) -->
        <div class="p-2 bg-white w-60 flex flex-col hidden md:flex" id="sideNav">
            <nav>
                <a href="{{ route('dashboard') }}" class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('stream') }}" class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white">
                    <i class="fas fa-file-alt mr-2"></i>Video Stream
                </a>
                <a href="{{ route('maps') }}" class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white">
                    <i class="fas fa-users mr-2"></i>Maps Integration
                </a>
            </nav>

            <!-- Ítem de Cerrar Sesión -->
            <!-- Ítem de Cerrar Sesión -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white mt-auto">
                    <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                </a>
            </form>

            <!-- Señalador de ubicación -->
            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mt-2"></div>

            <!-- Copyright al final de la navegación lateral -->
            <p class="mb-1 px-5 py-3 text-left text-xs text-cyan-500">Copyright WCSLAT@2023</p>

        </div>

        <!-- Área de contenido principal -->
        <div class="flex-1 p-4">
            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1t32nmcDe5osdjvhsT2P6162xKlkfjCU&ehbc=2E312F" width="640" height="480"></iframe>
        </div>
    </div>


    <!-- Script for the charts -->
    <script>
        // Users chart
        var usersChart = new Chart(document.getElementById('usersChart'), {
            type: 'doughnut',
            data: {
                labels: ['New', 'Registered'],
                datasets: [{
                    data: [30, 65],
                    backgroundColor: ['#00F0FF', '#8B8B8D'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom' // Place the legend below the circle
                }
            }
        });

        // Commerces chart
        var commercesChart = new Chart(document.getElementById('commercesChart'), {
            type: 'doughnut',
            data: {
                labels: ['New', 'Registered'],
                datasets: [{
                    data: [60, 40],
                    backgroundColor: ['#FEC500', '#8B8B8D'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom' // Place the legend below the circle
                }
            }
        });

        // Add logic to show/hide the side navigation when clicking on the menu icon
        const menuBtn = document.getElementById('menuBtn');
        const sideNav = document.getElementById('sideNav');

        menuBtn.addEventListener('click', () => {
            sideNav.classList.toggle('hidden'); // Add or remove the 'hidden' class to show or hide the side navigation
        });
    </script>
    </body>    </html>

