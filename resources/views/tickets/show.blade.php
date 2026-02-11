@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-slate-700">Ticket Details</h2>
            <a href="{{ route('tickets.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium py-2 px-4 rounded-lg flex items-center space-x-2 transition-all duration-200">
                <i class="fas fa-arrow-left text-sm"></i>
                <span class="text-sm">Back</span>
            </a>
        </div>

        <div class="bg-white/80 backdrop-blur-sm shadow-sm rounded-xl px-8 pt-6 pb-8 border border-slate-200">
            <div class="space-y-6">
                <div class="pb-4 border-b border-slate-100">
                    <div class="text-slate-500 text-xs font-medium mb-1">Ticket ID</div>
                    <div class="text-slate-700 text-sm font-medium">{{ $ticket->id }}</div>
                </div>

                <div class="pb-4 border-b border-slate-100">
                    <div class="text-slate-500 text-xs font-medium mb-2">Title</div>
                    <div class="text-slate-700 text-base font-medium">{{ $ticket->title }}</div>
                </div>

                <div class="pb-4 border-b border-slate-100">
                    <div class="text-slate-500 text-xs font-medium mb-2">Description</div>
                    <p class="text-slate-600 text-sm leading-relaxed bg-slate-50 p-4 rounded-lg">{{ $ticket->description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6 pb-4 border-b border-slate-100">
                    <div>
                        <div class="text-slate-500 text-xs font-medium mb-2">Status</div>
                        <span
                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full
                @if ($ticket->status === 'open') bg-green-100 text-green-800
                @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800
                @else bg-gray-100 text-gray-800 @endif">
                            @if ($ticket->status === 'open')
                                <i class="fas fa-folder-open mr-1"></i>
                            @elseif($ticket->status === 'in_progress')
                                <i class="fas fa-spinner mr-1"></i>
                            @else
                                <i class="fas fa-check-circle mr-1"></i>
                            @endif
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
                    </div>

                    <div>
                        <div class="text-slate-500 text-xs font-medium mb-2">Priority @endif
                            {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
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
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <div class="text-slate-500 text-xs font-medium mb-1">Created</div>
                        <div class="text-slate-600 text-sm">{{ $ticket->created_at->format('M d, Y - H:i') }}</div>
                    </div>

                    <div>
                        <div class="text-slate-500 text-xs font-medium mb-1">Last Updated</div>
                        <div class="text-slate-600 text-sm">{{ $ticket->updated_at->format('M d, Y - H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3 mt-6 pt-6 border-t border-slate-100">
                <a href="{{ route('tickets.edit', $ticket) }}"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-medium py-2.5 px-5 rounded-lg flex items-center space-x-2 transition-all duration-200">
                    <i class="fas fa-edit text-sm"></i>
                    <span class="text-sm">Edit</span>
                </a>
                <button onclick="openDeleteModal({{ $ticket->id }}, '{{ $ticket->title }}')"
                    class="bg-rose-50 hover:bg-rose-100 text-rose-600 font-medium py-2.5 px-5 rounded-lg flex items-center space-x-2 transition-all duration-200 border border-rose-200">
                    <i class="fas fa-trash-alt text-sm"></i>
                    <span class="text-sm"ass="text-sm text-gray-500 text-center">
                        Are you sure you want to delete ticket: <br>
                        <span class="font-bold text-gray-900" id="deleteTicketTitle"></span>?
                        <br><br>
                        This action cannot be undone.
                        </p>
            </div>
            <div class="flex items-center justify-center gap-4 mt-4">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 slate-900/20 backdrop-blur-sm overflow-y-auto h-full w-full z-50 transition-opacity duration-300">
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
