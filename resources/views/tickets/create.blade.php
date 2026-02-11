@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Create New Ticket</h2>

        <div class="bg-white/80 backdrop-blur-sm shadow-sm rounded-xl px-8 pt-6 pb-8 border border-slate-200">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-slate-600 text-sm font-medium mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="w-full px-4 py-2.5 text-slate-700 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-300 focus:border-transparent transition-all duration-200 @error('title') border-rose-300 bg-rose-50 @enderror"
                        id="title" type="text" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-slate-600 text-sm font-medium mb-2" for="description">
                        Description
                    </label>
                    <textarea
                        class="w-full px-4 py-2.5 text-slate-700 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-300 focus:border-transparent transition-all duration-200 @error('description') border-rose-300 bg-rose-50 @enderror"
                        id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-slate-600 text-sm font-medium mb-2" for="status">
                        Status
                    </label>
                    <select
                        class="w-full px-4 py-2.5 text-slate-700 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-300 focus:border-transparent transition-all duration-200 @error('status') border-rose-300 bg-rose-50 @enderror"
                        id="status" name="status" required>
                        <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-slate-600 text-sm font-medium mb-2" for="priority">
                        Priority
                    </label>
                    <select
                        class="w-full px-4 py-2.5 text-slate-700 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-300 focus:border-transparent transition-all duration-200 @error('priority') border-rose-300 bg-rose-50 @enderror"
                        id="priority" name="priority" required>
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <p class="text-rose-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('tickets.index') }}"
                        class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-slate-700 transition-all duration-200 font-medium">
                        <i class="fas fa-arrow-left text-xs"></i>
                        <span>Back</span>
                    </a>
                    <button
                        class="bg-slate-600 hover:bg-slate-700 text-white font-medium py-2.5 px-6 rounded-lg focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                        type="submit">
                        Create Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
