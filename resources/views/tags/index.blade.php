<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
        <x-primary-button class="ms-auto gap-2" x-data=""
                               x-on:click.prevent="$dispatch('open-modal', 'form-new-tag-group')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
            {{ __('New Tag Group') }}
        </x-primary-button>
    </x-slot>

    <div class="py-12" x-data="tagIndex()" x-init="flashMessage()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 flex flex-col">
            @if (count($tagGroups) == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span>You don't have any tags</span>
                </div>
            </div>
            @else
            <div class="gap-4 grid">
                @foreach ($tagGroups as $tagGroup)
                <div class="bg-white shadow sm:rounded-lg relative overflow-hidden p-6">
                    <span class="font-semibold text-lg text-gray-800 leading-tight">{{ $tagGroup->name }}</span>
                </div>
                @endforeach
            </div>
            {{ $tagGroups->onEachSide(5)->links() }}
            @endif
        </div>
        <x-modal name="form-new-tag-group">
            <form method="post" class="p-6" action="{{ route('tag-groups.store') }}" focusable>
                @csrf
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('New Tag Group') }}
                </h2>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tag Group *</label>
                    <input type="text" x-model="tagGroupName" id="name" name="name" class="w-full border rounded p-2">
                </div>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:active:bg-gray-700 dark:hover:active:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 disabled:opacity-25 gap-2 hover:disabled:cursor-not-allowed"
                        :disabled="tagGroupName.length === 0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    {{ __('Save') }}
                </button>
            </form>
        </x-modal>
    </div>

    <script>
        function tagIndex() {
            return {
                tagGroupName: '',
                flashNotification: {!! json_encode(session()->get('success')) ?? 'null' !!},
                flashMessage() {
                    setTimeout(() => {
                        if (this.flashNotification === null) return;
                        this.$dispatch('push-notification', this.flashNotification);
                    }, 100)
                }
            }
        }
    </script>
</x-app-layout>
