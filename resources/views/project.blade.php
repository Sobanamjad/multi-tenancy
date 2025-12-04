<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-500 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Projects</h2>

                    {{-- Add Project Button --}}
                    <button
                        onclick="document.getElementById('projectForm').classList.toggle('hidden')"
                        class="px-4 py-2 bg-blue-600 text-white rounded mb-4">
                        + Add Project
                    </button>

                    {{-- Add Project Form --}}
                    <div id="projectForm" class="hidden mb-4">
                        <form action="{{ route('projects.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="text" name="name" placeholder="Enter project name"
                                   class="w-full p-2 rounded border text-black dark:text-white dark:bg-gray-700" required>
                            <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Save</button>
                        </form>
                    </div>

                    {{-- Projects List --}}
                    @if($projects->count() == 0)
    <p class="text-gray-400 mt-4">No project found.</p>
@else
    <ul class="mt-4">
        @foreach($projects as $project)
            <li class="flex justify-between items-center p-2 border-b border-gray-700">

                {{-- Left: Project Name --}}
                <div class="flex-1">
                    <span class="project-name">{{ $project->name }}</span>

                    {{-- Inline Edit Form (hidden by default) --}}
                    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="inline edit-form hidden">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $project->name }}"
                               class="p-1 rounded border text-black dark:text-white dark:bg-gray-700">
                        <button class="px-2 py-1 bg-green-600 text-white rounded">Update</button>
                        <button type="button"
                                onclick="this.closest('form').classList.add('hidden'); this.closest('li').querySelector('.project-name').classList.remove('hidden');"
                                class="px-2 py-1 bg-gray-500 text-white rounded">Cancel</button>
                    </form>
                </div>

                {{-- Right: Buttons --}}
                <div class="space-x-2 flex-shrink-0">
                    <button type="button"
                            onclick="toggleEditForm(this)"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Edit
                    </button>

                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this project?');"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
@endif

<script>
    function toggleEditForm(button) {
        const li = button.closest('li');
        const form = li.querySelector('.edit-form');
        const nameSpan = li.querySelector('.project-name');
        form.classList.toggle('hidden');
        nameSpan.classList.toggle('hidden');
    }
</script>

</x-app-layout>
