<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ticket System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-gray-50 to-slate-100 min-h-screen">
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-slate-600 to-slate-700 p-2 rounded-lg">
                        <i class="fas fa-ticket-alt text-xl text-white"></i>
                    </div>
                    <h1 class="text-2xl font-semibold text-slate-700">Ticket System</h1>
                </div>
                <a href="{{ route('tickets.index') }}"
                    class="flex items-center space-x-2 bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-list text-sm"></i>
                    <span class="text-sm font-medium">All Tickets</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        @if (session('success'))
            <div
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center">
                <i class="fas fa-check-circle text-xl mr-3 text-emerald-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        function openDeleteModal(ticketId, ticketTitle) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteTicketTitle').textContent = ticketTitle;
            document.getElementById('deleteForm').action = '/tickets/' + ticketId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>

</html>
