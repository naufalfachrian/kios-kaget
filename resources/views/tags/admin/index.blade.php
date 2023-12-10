<x-admin-layout>
    <x-admin-header>
        <x-slot name="title">
            {{ __('Tags') }}
        </x-slot>
        <x-slot name="right">
            <x-admin-header-button
                click="$dispatch('open-modal', 'form-new-tag-group'); $dispatch('setup-form-tag-group', {action: '{{ route('tag-groups.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'}); $dispatch('reset-form-tag-group');">
                <x-heroicons-sparkles></x-heroicons-sparkles>
                {{ __('New Tag Group') }}
            </x-admin-header-button>
        </x-slot>
    </x-admin-header>

    <div x-data="tagAdminIndex()">
        @if (count($tagGroups) == 0)
            <x-hero-warning text="You don't have any tags"></x-hero-warning>
        @else
            <div class="gap-4 grid">
                @foreach ($tagGroups as $tagGroup)
                    <div class="bg-brand-white shadow sm:rounded-lg relative overflow-hidden p-6 gap-2 flex flex-col">
                        <span class="font-semibold text-lg text-gray-800 leading-tight">{{ $tagGroup->name }}</span>
                        <x-admin-item-button
                            edit="$dispatch('setup-form-tag-group', {action: '{!! route('tag-groups.update', $tagGroup) !!}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-tag-group', JSON.parse('{!! $tagGroup !!}')); $dispatch('open-modal', 'form-new-tag-group');"
                            delete="$dispatch('setup-form-tag-group', {action: '{!! route('tag-groups.update', $tagGroup) !!}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-tag-group', JSON.parse('{!! $tagGroup !!}')); $dispatch('open-modal', 'confirm-tag-group-deletion');"
                        >
                        </x-admin-item-button>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tagGroup->tags as $tag)
                                <button type="button" class="rounded-full bg-brand-yellow shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-2"
                                        x-on:click="$dispatch('open-modal', 'form-new-tag'); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('select-tag', JSON.parse('{{ $tag }}')); $dispatch('setup-form-tag', {action: '{{ route('tags.update', $tag) }}', method: 'patch', submitButtonText: '{{ __('Update') }}'});">
                                    <div class="bg-brand-white rounded-full w-3 h-3"></div>
                                    <span class="text-brand-white">{{ $tag->name }}</span>
                                </button>
                            @endforeach
                            <button type="button" class="rounded-full bg-brand-black shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-1 text-brand-white"
                                    x-on:click="$dispatch('open-modal', 'form-new-tag'); $dispatch('reset-form-tag'); $dispatch('select-tag-group', JSON.parse('{{ $tagGroup }}')); $dispatch('setup-form-tag', {action: '{{ route('tags.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'});">
                                <div class="bg-brand-white rounded-full w-3 h-3"></div>
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
        function tagAdminIndex() {
            return {
            }
        }
    </script>
</x-admin-layout>
