<form x-data="formCategoryGroup" method="post" class="p-6" :action="props.action" focusable
      @select-category-group.window="selectCategoryGroup($event.detail)"
      @setup-form-category-group.window="setup($event.detail)"
      @reset-form-category-group.window="reset()">
    @csrf
    <input hidden name="_method" x-model="props.method">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        <template x-if="categoryGroup.id === null">
            <span>{{ __('New Category Group') }}</span>
        </template>
        <template x-if="categoryGroup.id !== null">
            <span>{{ __('Update Category Group ') }}<span x-text="categoryGroup.name"></span></span>
        </template>
    </h2>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm mb-2">{{ __('Category Group *') }}</label>
        <input type="text" x-model="categoryGroup.name" id="name" name="name" class="w-full border rounded p-2" autofocus>
    </div>
    <button type="submit"
            class="btn--primary"
            :disabled="categoryGroup.name === null || categoryGroup.name.length === 0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <span x-text="props.submitButtonText"></span>
    </button>
</form>

<script>
    function formCategoryGroup() {
        return {
            props: {
                action: '',
                method: '',
                submitButtonText: '',
            },
            categoryGroup: {
                id: null,
                name: null
            },
            reset() {
                this.categoryGroup = {
                    id: null,
                    name: null
                }
            },
            selectCategoryGroup(categoryGroup) {
                this.categoryGroup = categoryGroup;
            },
            setup(props) {
                this.props = props;
            },
        }
    }
</script>
