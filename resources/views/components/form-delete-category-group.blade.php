<form x-data="formDeleteCategoryGroup" method="post" x-ref="form" class="p-6" :action="props.action"
      @select-category-group.window="selectCategoryGroup($event.detail)"
      @setup-form-category-group.window="setup($event.detail)"
      @reset-form-category-group.window="reset()">
    @csrf
    @method('delete')

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete category group named ') }}<span x-text="categoryGroup.name"></span>{{ __('?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your category group is deleted, it will be permanently delete all categorys under the group. The products associated with the categorys won\'t be deleted.') }}
    </p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3">
            {{ __('Delete') }}
        </x-danger-button>
    </div>
</form>

<script>
    function formDeleteCategoryGroup() {
        return {
            props: {
                action: '',
            },
            categoryGroup: {
                id: null,
                name: null,
            },
            reset() {
                this.categoryGroup = {
                    id: null,
                    name: null,
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
