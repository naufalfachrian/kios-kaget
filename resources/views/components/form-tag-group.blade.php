<form x-data="formTagGroup" method="post" class="p-6" :action="props.action" focusable
      @select-tag-group.window="selectTagGroup($event.detail)"
      @setup-form-tag-group.window="setup($event.detail)"
      @reset-form-tag-group.window="reset()">
    @csrf
    <input hidden name="_method" x-model="props.method">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        <template x-if="tagGroup.id === null">
            <span>{{ __('New Tag Group') }}</span>
        </template>
        <template x-if="tagGroup.id !== null">
            <span>{{ __('Update Tag Group ') }}<span x-text="tagGroup.name"></span></span>
        </template>
    </h2>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Tag Group *') }}</label>
        <input type="text" x-model="tagGroup.name" id="name" name="name" class="w-full border rounded p-2" autofocus>
    </div>
    <button type="submit"
            class="btn--primary"
            :disabled="tagGroup.name === null || tagGroup.name.length === 0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <span x-text="props.submitButtonText"></span>
    </button>
</form>

<script>
    function formTagGroup() {
        return {
            props: {
                action: '',
                method: '',
                submitButtonText: '',
            },
            tagGroup: {
                id: null,
                name: null
            },
            reset() {
                this.tagGroup = {
                    id: null,
                    name: null
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
