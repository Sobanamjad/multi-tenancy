<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-500 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Projects</h2>

                    <button
                        onclick="document.getElementById('projectForm').classList.toggle('hidden')"
                        class="px-4 py-2 bg-blue-600 text-white rounded mb-4">
                        + Add Project
                    </button>

                    <div id="projectForm" class="hidden mb-4">
                        <form action="{{ route('projects.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="text" name="name" placeholder="Enter project name"
                            class="w-full p-2 rounded border text-black dark:text-white dark:bg-gray-700" required>
                            <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Save</button>
                        </form>
                    </div>

                    {{-- Correct Condition --}}
                    @if($projects->count() == 0)
                        <p class="text-gray-400 mt-4">No project found.</p>
                    @else
                        <ul class="mt-4">
                            @foreach($projects as $project)
                                <li class="p-2 border-b border-gray-700">{{ $project->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
