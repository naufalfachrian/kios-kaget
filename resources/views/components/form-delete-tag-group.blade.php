<form x-data="formDeleteTagGroup" method="post" x-ref="form" class="p-6" :action="props.action"
      @select-tag-group.window="selectTagGroup($event.detail)"
      @setup-form-tag-group.window="setup($event.detail)"
      @reset-form-tag-group.window="reset()">
    @csrf
    @method('delete')

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete tag group named ') }}<span x-text="tagGroup.name"></span>{{ __('?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your tag group is deleted, it will be permanently delete all tags under the group. The products associated with the tags won\'t be deleted.') }}
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
    function formDeleteTagGroup() {
        return {
            props: {
                action: '',
            },
            tagGroup: {
                id: null,
                name: null,
            },
            reset() {
                this.tagGroup = {
                    id: null,
                    name: null,
                }
            },
            selectTagGroup(tagGroup) {
                this.tagGroup = tagGroup;
            },
            setup(props) {
                this.props = props;
            },
        }
    }
</script>
