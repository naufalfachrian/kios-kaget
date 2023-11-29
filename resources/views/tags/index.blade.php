<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
        <button class="btn--primary ms-auto" x-data=""
                               x-on:click.prevent="$dispatch('open-modal', 'form-new-tag-group')">
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
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tagGroup->tags as $tag)
                        <button type="button" class="rounded-full bg-green-100 shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-2"
                                x-on:click="$dispatch('open-modal', 'form-new-tag'); selectedTagGroup = JSON.parse('{{ $tagGroup }}'); selectedTag = JSON.parse('{{ $tag }}'); formNewTagProps.action = '{{ route('tags.update', $tag) }}'; formNewTagProps.method = 'patch'; formNewTagProps.buttonText = '{{ __('Update') }}'">
                            <div class="bg-white rounded-full w-3 h-3"></div>
                            {{ $tag->name }}
                        </button>
                        @endforeach
                        <button type="button" class="rounded-full bg-orange-100 shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-1"
                                x-on:click="$dispatch('open-modal', 'form-new-tag'); selectedTagGroup = JSON.parse('{{ $tagGroup }}'); resetSelectedTag(); formNewTagProps.action = '{{ route('tags.store') }}'; formNewTagProps.method = 'post'; formNewTagProps.buttonText = '{{ __('Save') }}'">
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
                        class="btn--primary"
                        :disabled="tagGroupName.length === 0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    {{ __('Save') }}
                </button>
            </form>
        </x-modal>
        <x-modal name="form-new-tag">
            <form method="post" class="p-6" :action="formNewTagProps.action" focusable>
                @csrf
                <input hidden name="_method" x-model="formNewTagProps.method">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    <template x-if="selectedTag.id === null">
                        <span>{{ __('New Tag on ') }}<span x-text="selectedTagGroup.name"></span></span>
                    </template>
                    <template x-if="selectedTag.id !== null">
                        <span>{{ __('Update Tag ') }}<span x-text="selectedTag.name"></span></span>
                    </template>
                </h2>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tag *</label>
                    <input type="text" x-model="selectedTag.name" id="name" name="name" class="w-full border rounded p-2">
                </div>
                <input hidden type="text" x-model="selectedTagGroup.id" id="tag_group_id" name="tag_group_id">
                <div class="flex">
                    <button type="submit"
                            class="btn--primary"
                            :disabled="selectedTag.name === null || selectedTag.name.length === 0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span x-text="formNewTagProps.buttonText"></span>
                    </button>
                    <x-secondary-button x-on:click="$dispatch('close')" class="ms-auto">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <template x-if="selectedTag.id !== null">
                        <button form="form_tag_delete" type="submit"
                            class="btn--danger ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>{{ __('Delete') }}</span>
                            <form hidden method="post" :action="formNewTagProps.action" id="form_tag_delete">
                                @csrf
                                @method("DELETE")
                            </form>
                        </button>
                    </template>
                </div>
            </form>
        </x-modal>
    </div>

    <script>
        function tagIndex() {
            return {
                tagGroupName: '',
                selectedTagGroup: {
                    name: null,
                    id: null,
                },
                selectedTag: {
                    tag_group_id: null,
                    name: null,
                    id: null,
                },
                formNewTagProps: {
                    action: null,
                    method: null,
                    buttonText: null,
                },
                flashNotification: {!! json_encode(session()->get('success')) ?? 'null' !!},
                flashMessage() {
                    setTimeout(() => {
                        if (this.flashNotification === null) return;
                        this.$dispatch('push-notification', this.flashNotification);
                    }, 100)
                },
                resetSelectedTag() {
                    this.selectedTag = {
                        tag_group_id: null,
                        name: null,
                        id: null,
                    }
                }
            }
        }
    </script>
</x-app-layout>
