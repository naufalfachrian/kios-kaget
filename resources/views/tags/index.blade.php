<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
        <button class="btn--primary ms-auto" x-data=""
                               x-on:click="$dispatch('open-modal', 'form-new-tag-group'); $dispatch('setup-form-tag-group', {action: '{{ route('tag-groups.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'}); $dispatch('reset-form-tag-group');">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
            {{ __('New Tag Group') }}
        </button>
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
                <div class="bg-white shadow sm:rounded-lg relative overflow-hidden p-6 gap-2 flex flex-col">
                    <span class="font-semibold text-lg text-gray-800 leading-tight">{{ $tagGroup->name }}</span>
                    <div class="absolute right-0 top-0 mt-2 me-2 gap-1.5 flex">
                        <button class="shadow-sm hover:shadow bg-yellow-500/60 backdrop-blur-xl hover:bg-yellow-600/80 p-2 rounded-lg text-white"
                                x-on:click="$dispatch('setup-form-tag-group', {action: '{{ route('tag-groups.update', $tagGroup) }}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('open-modal', 'form-new-tag-group');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button class="shadow-sm hover:shadow bg-red-500/60 backdrop-blur-xl hover:bg-red-600/80 p-2 rounded-lg text-white"
                                x-on:click="$dispatch('setup-form-tag-group', {action: '{{ route('tag-groups.update', $tagGroup) }}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('open-modal', 'confirm-tag-group-deletion');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tagGroup->tags as $tag)
                        <button type="button" class="rounded-full bg-green-100 shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-2"
                                x-on:click="$dispatch('open-modal', 'form-new-tag'); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('select-tag', JSON.parse('{{ $tag }}')); $dispatch('setup-form-tag', {action: '{{ route('tags.update', $tag) }}', method: 'patch', submitButtonText: '{{ __('Update') }}'});">
                            <div class="bg-white rounded-full w-3 h-3"></div>
                            {{ $tag->name }}
                        </button>
                        @endforeach
                        <button type="button" class="rounded-full bg-orange-100 shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-1"
                                x-on:click="$dispatch('open-modal', 'form-new-tag'); $dispatch('reset-form-tag'); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('setup-form-tag', {action: '{{ route('tags.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'});">
                            <div class="bg-white rounded-full w-3 h-3"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                            New Tag on {{ $tagGroup->name }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $tagGroups->onEachSide(5)->links() }}
            @endif
        </div>
        <x-modal name="form-new-tag-group">
            <x-form-tag-group></x-form-tag-group>
        </x-modal>
        <x-modal name="form-new-tag">
            <x-form-tag></x-form-tag>
        </x-modal>
        <x-modal name="confirm-tag-group-deletion" focusable>
            <x-form-delete-tag-group></x-form-delete-tag-group>
        </x-modal>
    </div>

    <script>
        function tagIndex() {
            return {
                flashNotification: {!! json_encode(session()->get('success')) ?? 'null' !!},
                flashMessage() {
                    setTimeout(() => {
                        if (this.flashNotification === null) return;
                        this.$dispatch('push-notification', this.flashNotification);
                    }, 100)
                },
            }
        }
    </script>
</x-app-layout>
