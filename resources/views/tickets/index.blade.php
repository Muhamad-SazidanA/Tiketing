@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-slate-700">All Tickets</h2>
        <a href="{{ route('tickets.create') }}"
            class="flex items-center space-x-2 bg-slate-600 hover:bg-slate-700 text-white font-medium py-2.5 px-5 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
            <i class="fas fa-plus text-sm"></i>
            <span class="text-sm">New Ticket</span>
        </a>
    </div>

    <div class="bg-white/80 backdrop-blur-sm shadow-sm rounded-xl overflow-hidden border border-slate-200">
        <table class="min-w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Title
                    </th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Priority</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Created</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white/50 divide-y divide-slate-100">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-slate-50/50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 text-center font-medium">
                            {{ $ticket->id }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700 text-center font-medium">{{ $ticket->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="px-3 py-1.5 inline-flex text-xs leading-5 font-medium rounded-lg 
                        @if ($ticket->status === 'open') bg-emerald-50 text-emerald-700 border border-emerald-200
                        @elseif($ticket->status === 'in_progress') bg-amber-50 text-amber-700 border border-amber-200
                        @else bg-slate-100 text-slate-600 border border-slate-200 @endif">
                                @if ($ticket->status === 'open')
                                    <i class="fas fa-circle text-[8px] mr-1.5 text-emerald-500"></i>
                                @elseif($ticket->status === 'in_progress')
                                    <i class="fas fa-circle text-[8px] mr-1.5 text-amber-500"></i>
                                @else
                                    <i class="fas fa-circle text-[8px] mr-1.5 text-slate-400"></i>
                                @endif
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span
                                class="px-3 py-1.5 inline-flex text-xs leading-5 font-medium rounded-lg
                        @if ($ticket->priority === 'high') bg-rose-50 text-rose-700 border border-rose-200
                        @elseif($ticket->priority === 'medium') bg-orange-50 text-orange-700 border border-orange-200
                        @else bg-sky-50 text-sky-700 border border-sky-200 @endif">
                                @if ($ticket->priority === 'high')
                                    <i class="fas fa-arrow-up text-[8px] mr-1.5 text-rose-500"></i>
                                @elseif($ticket->priority === 'medium')
                                    <i class="fas fa-minus text-[8px] mr-1.5 text-orange-500"></i>
                                @else
                                    <i class="fas fa-arrow-down text-[8px] mr-1.5 text-sky-500"></i>
                                @endif
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 text-center">
                            {{ $ticket->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('tickets.show', $ticket) }}"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg transition-all duration-200 inline-flex items-center space-x-1.5">
                                    <i class="fas fa-eye text-xs"></i>
                                    <span class="text-xs font-medium">View</span>
                                </a>
                                <a href="{{ route('tickets.edit', $ticket) }}"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg transition-all duration-200 inline-flex items-center space-x-1.5">
                                    <i class="fas fa-edit text-xs"></i>
                                    <span class="text-xs font-medium">Edit</span>
                                </a>
                                <button onclick="openDeleteModal({{ $ticket->id }}, '{{ $ticket->title }}')"
                                    class="bg-rose-50 hover:bg-rose-100 text-rose-600 px-3 py-1.5 rounded-lg transition-all duration-200 inline-flex items-center space-x-1.5 border border-rose-200">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                    <span class="text-xs font-medium">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <i class="fas fa-inbox text-4xl mb-3 text-slate-300"></i>
                            <p class="text-sm font-medium">No tickets found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tickets->links() }}
    </div>

    <div id="deleteModal"
        class="hidden fixed inset-0 bg-slate-900/20 backdrop-blur-sm overflow-y-auto h-full w-full z-50 transition-opacity duration-300">
        <div class="relative top-20 mx-auto p-6 w-96 shadow-lg rounded-2xl bg-white border border-slate-200">
            <div class="">
                <div
                    class="flex items-center justify-center w-14 h-14 mx-auto bg-rose-50 rounded-full border border-rose-200">
                    <i class="fas fa-exclamation-triangle text-rose-500 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-700 mt-4 text-center">Delete Ticket</h3>
                <div class="mt-3 px-4 py-2">
                    <p class="text-sm text-slate-500 text-center leading-relaxed">
                        Are you sure you want to delete: <br>
                        <span class="font-semibold text-slate-700" id="deleteTicketTitle"></span>?
                        <br><br>
                        <span class="text-xs text-slate-400">This action cannot be undone.</span>
                    </p>
                </div>
                <div class="flex items-center justify-center gap-3 mt-6">
                    <button onclick="closeDeleteModal()"
                        class="px-5 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-all duration-200 text-sm font-medium">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-5 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition-all duration-200 text-sm font-medium shadow-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
