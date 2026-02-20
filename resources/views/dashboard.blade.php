<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="status-message" class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 shadow-sm transition-opacity duration-500">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        let msg = document.getElementById('status-message');
                        if (msg) {
                            msg.style.opacity = '0';
                            setTimeout(() => msg.remove(), 500);
                        }
                    }, 5000);
                </script>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 border border-gray-100 shadow-sm">
                <h3 class="text-lg font-medium mb-4">Start a New Project</h3>
                <form action="{{ route('projects.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="title" placeholder="Enter project name..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 flex-1" required>
                    <button type="submit" style="background-color: #4f46e5; color: white; font-weight: bold; padding: 8px 24px; border-radius: 6px;">
                        + Create Project
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500 shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $project->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $project->tasks->where('is_completed', true)->count() }} / {{ $project->tasks->count() }} Tasks Completed
                                    </p>
                                </div>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>

                            <div class="space-y-3 mb-4">
                                @foreach($project->tasks as $task)
                                    <div class="flex justify-between items-center group">
                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                            <form action="{{ route('tasks.update', $task) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="is_completed" value="0">
                                                <input type="checkbox" name="is_completed" value="1" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer">
                                            </form>
                                            <span class="{{ $task->is_completed ? 'line-through text-gray-400 italic' : '' }}">
                                                {{ $task->description }}
                                            </span>
                                        </div>

                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <form action="{{ route('tasks.store', $project) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="text" name="description" placeholder="New task..." class="text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 flex-1 h-9" required>
                                <button type="submit" style="background-color: #4f46e5; color: white; font-weight: bold; padding: 4px 16px; border-radius: 6px; font-size: 12px; height: 36px; white-space: nowrap;">
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500 italic">No projects found. Create your first one above! 🚀</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>