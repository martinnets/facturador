<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Mi Aplicación MVC'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> 
     <!-- DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
    <style>
       body {
            font-family: 'Inter', sans-serif;
        }
        /* Clases para la transición del sidebar */
        .sidebar-expanded {
            width: 16rem; /* 256px */
        }
        .sidebar-collapsed {
            width: 4rem; /* 64px */
        }
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        .sidebar-collapsed .sidebar-logo-text {
            display: none;
        }
         .sidebar-collapsed .sidebar-footer-text {
            display: none;
        }
        .sidebar-expanded .sidebar-icon-only {
            display: none;
        }
         /* Estilo para el ícono cuando el sidebar está colapsado y el texto está oculto */
        .sidebar-collapsed .nav-link i {
            margin-right: 0 !important; /* Quita el margen derecho del ícono */
            width: 100%; /* Hace que el ícono ocupe todo el espacio del enlace */
            text-align: center; /* Centra el ícono */
        }
        .sidebar-collapsed .nav-link {
            justify-content: center; /* Centra el ícono dentro del enlace */
        }

        /* Ajuste del contenido principal */
        .content-expanded {
            margin-left: 16rem; /* 256px */
        }
        .content-collapsed {
            margin-left: 4rem; /* 64px */
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">