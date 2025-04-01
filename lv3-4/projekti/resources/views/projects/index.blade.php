<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Led Projects</h2>
                            <ul class="mt-2 space-y-2">
                                @forelse($ledProjects as $project)
                                    <li class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-md">
                                        <span>{{ $project->name }}</span>
                                        <a href="{{ route('projects.edit', $project) }}" 
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                            Edit
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-gray-500 dark:text-gray-400">No led projects yet.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Team Projects</h2>
                            <ul class="mt-2 space-y-2">
                                @forelse($teamProjects as $project)
                                    <li class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-md">
                                        <span>{{ $project->name }}</span>
                                        <a href="{{ route('projects.edit', $project) }}" 
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                            Edit
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-gray-500 dark:text-gray-400">No team projects yet.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div>
                            <a href="{{ route('projects.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create New Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>