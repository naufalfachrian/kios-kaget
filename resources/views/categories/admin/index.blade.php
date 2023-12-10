<x-admin-layout>
    <x-admin-header>
        <x-slot name="title">
            {{ __('Categories') }}
        </x-slot>
        <x-slot name="right">
            <x-admin-header-button
                click="$dispatch('open-modal', 'form-new-category-group'); $dispatch('setup-form-category-group', {action: '{{ route('category-groups.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'}); $dispatch('reset-form-category-group');">
                <x-heroicons-sparkles></x-heroicons-sparkles>
                {{ __('New Category Group') }}
            </x-admin-header-button>
        </x-slot>
    </x-admin-header>

    <div x-data="categoryAdminIndex()">
        @if (count($categoryGroups) == 0)
            <x-hero-warning text="You don't have any categories"></x-hero-warning>
        @else
            <div class="gap-4 grid">
                @foreach ($categoryGroups as $categoryGroup)
                    <div class="bg-brand-white shadow sm:rounded-lg relative overflow-hidden p-6 gap-2 flex flex-col">
                        <span class="font-semibold text-lg text-gray-800 leading-tight">{{ $categoryGroup->name }}</span>
                        <x-admin-item-button
                            edit="$dispatch('setup-form-category-group', {action: '{!! route('category-groups.update', $categoryGroup) !!}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-category-group', JSON.parse('{!! $categoryGroup !!}')); $dispatch('open-modal', 'form-new-category-group');"
                            delete="$dispatch('setup-form-category-group', {action: '{!! route('category-groups.update', $categoryGroup) !!}', method: 'patch', submitButtonText: '{{ __('Update') }}'}); $dispatch('select-category-group', JSON.parse('{!! $categoryGroup !!}')); $dispatch('open-modal', 'confirm-category-group-deletion');"
                        >
                        </x-admin-item-button>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($categoryGroup->categories as $category)
                                <button type="button" class="rounded-full bg-brand-yellow shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-2"
                                        x-on:click="$dispatch('open-modal', 'form-new-category'); $dispatch('select-category-group', JSON.parse('{{ $categoryGroup }}')); $dispatch('select-category', JSON.parse('{{ $category }}')); $dispatch('setup-form-category', {action: '{{ route('categories.update', $category) }}', method: 'patch', submitButtonText: '{{ __('Update') }}'});">
                                    <div class="bg-brand-white rounded-full w-3 h-3"></div>
                                    <span class="text-brand-white">{{ $category->name }}</span>
                                </button>
                            @endforeach
                            <button type="button" class="rounded-full bg-brand-black shadow-sm text-sm py-2 px-4 flex flex-row items-center gap-1 text-brand-white"
                                    x-on:click="$dispatch('open-modal', 'form-new-category'); $dispatch('reset-form-category'); $dispatch('select-category-group', JSON.parse('{{ $categoryGroup }}')); $dispatch('setup-form-category', {action: '{{ route('categories.store') }}', method: 'post', submitButtonText: '{{ __('Save') }}'});">
                                <div class="bg-brand-white rounded-full w-3 h-3"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                New Category on {{ $categoryGroup->name }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-4 pb-4">
                {{ $categoryGroups->onEachSide(5)->links() }}
            </div>
        @endif
        <x-modal name="form-new-category-group">
            <x-form-category-group></x-form-category-group>
        </x-modal>
        <x-modal name="form-new-category">
            <x-form-category></x-form-category>
        </x-modal>
        <x-modal name="confirm-category-group-deletion" focusable>
            <x-form-delete-category-group></x-form-delete-category-group>
        </x-modal>
    </div>

    <script>
        function categoryAdminIndex() {
            return {
            }
        }
    </script>
</x-admin-layout>
