<form x-data="formCategory" method="post" class="p-6" :action="props.action" focusable
      @select-category.window="selectCategory($event.detail)"
      @select-category-group.window="selectCategoryGroup($event.detail)"
      @setup-form-category.window="setup($event.detail)"
      @reset-form-category.window="reset()">
    @csrf
    <input hidden name="_method" x-model="props.method">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        <template x-if="category.id === null">
            <span>{{ __('New Category on ') }}<span x-text="category.name"></span></span>
        </template>
        <template x-if="category.id !== null">
            <span>{{ __('Update Category ') }}<span x-text="category.name"></span></span>
        </template>
    </h2>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm mb-2">Category *</label>
        <input type="text" x-model="category.name" id="name" name="name" class="w-full border rounded p-2" autofocus>
    </div>
    <input hidden type="text" x-model="category.category_group_id" id="category_group_id" name="category_group_id">
    <div class="flex">
        <button type="submit"
                class="btn--primary"
                :disabled="category.name === null || category.name.length === 0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <span x-text="props.submitButtonText"></span>
        </button>
        <x-secondary-button x-on:click="$dispatch('close')" class="ms-auto">
            {{ __('Cancel') }}
        </x-secondary-button>
        <template x-if="category.id !== null">
            <button form="form_category_delete" type="submit"
                    class="btn--danger ms-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                <span>{{ __('Delete') }}</span>
                <form hidden method="post" :action="props.action" id="form_category_delete">
                    @csrf
                    @method("DELETE")
                </form>
            </button>
        </template>
    </div>
</form>

<script>
    function formCategory() {
        return {
            props: {
                action: '',
                method: '',
                submitButtonText: '',
            },
            category: {
                id: null,
                name: null,
                category_group_id: null,
            },
            reset() {
                this.category = {
                    id: null,
                    name: null,
                    category_group_id: null,
                }
            },
            selectCategoryGroup(categoryGroup) {
                this.category.category_group_id = categoryGroup.id;
            },
            selectCategory(category) {
                this.category = category;
            },
            setup(props) {
                this.props = props;
            },
        }
    }
</script>
