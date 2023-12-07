@props([
    'name',
    'class'
])

<form x-data="formProductImage()" method="post" class="{{ $class }}" x-ref="form"
      @product-image-set.window="selected = $event.detail"
      @reset-form.window="$event.detail === '{{ $name }}' ? reset() : null"
      @submit.prevent="submit()">
    @csrf

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        {{ __('Product Image') }}
    </h2>

    <div class="lg:grid lg:grid-cols-2 flex flex-col gap-3">

        <div
            class="w-full overflow-clip aspect-square border border-dashed border-gray-500 rounded-lg auto bg-clip-padding flex items-center justify-center">
            <img class="rounded-lg" :src="selected.image_url"/>
        </div>

        <div class="flex flex-col grow">
            <div class="mb-4">
                <label for="image_name" class="block text-gray-700 text-sm font-bold mb-2">Image
                    Label</label>
                <input type="text" id="image_name" name="image_name" class="w-full border rounded p-2"
                       x-model="selected.image_name">
            </div>

            <div class="mb-4">
                <label for="image_file" class="block text-gray-700 text-sm font-bold mb-2">Upload Image
                    *</label>
                <input type="file" accept="image/*" id="image_file" name="image_file" x-ref="image_file"
                       class="w-full border rounded p-2" @change="reloadPreview()">
            </div>
        </div>

    </div>

    <div class="mt-6 flex gap-3">
        <button :class="{'cursor-not-allowed': isUploading || selected.image_url === null}"
                :disabled="isUploading || selected.image_url === null"
                class="btn--primary">
            <svg :hidden="isUploading" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <svg :hidden="!isUploading"
                 class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <template x-if="selected.id === null">
                <span>{{ __('Save') }}</span>
            </template>
            <template x-if="selected.id !== null">
                <span>{{ __('Update') }}</span>
            </template>
        </button>

        <x-secondary-button class="ms-auto" @click="$dispatch('product-image-form-canceled')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <template x-if="selected.id !== null">
            <button type="button" class="flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    @click="remove()">
                <svg :hidden="!isDeleting"
                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('Delete') }}
            </button>
        </template>
    </div>
</form>

<script>
    function formProductImage() {
        return {
            selected: {
                id: null,
                product_id: null,
                image_name: null,
                image_url: null,
                created_at: null,
                updated_at: null,
            },
            isUploading: false,
            isDeleting: false,
            reloadPreview() {
                let file = this.$refs.image_file.files[0];
                if (!file || file.type.indexOf('image/') === -1) return;
                this.selected.image_url = null;
                let reader = new FileReader();
                reader.onload = e => {
                    this.selected.image_url = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            submit() {
                if (this.selected.id === null) {
                    this.post();
                } else {
                    this.patch();
                }
            },
            post() {
                this.isUploading = true;
                let file = this.$refs.image_file.files[0];
                if (!file || file.type.indexOf('image/') === -1) {
                    this.isUploading = false;
                    return
                }
                const formData = new FormData();
                formData.append('image', file);
                if (this.selected.image_name != null) {
                    formData.append('image_name', this.selected.image_name);
                }
                fetch('{{ route('product-images.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}'
                    }
                }).then(response => response.json()).then(response => {
                    this.reset();
                    this.$dispatch('product-image-stored', response);
                });
            },
            patch() {
                this.isUploading = true;
                const formData = new FormData();
                let file = this.$refs.image_file.files[0];
                if (file && file.type.indexOf('image/') !== -1) {
                    formData.append('image', file);
                }
                if (this.selected.image_name != null) {
                    formData.append('image_name', this.selected.image_name);
                }
                fetch('{{ route('product-images.store') }}/' + this.selected.id + '?_method=PATCH', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}',
                    }
                }).then(response => response.json()).then(response => {
                    this.reset();
                    this.selected = response;
                    this.$dispatch('product-image-patched', response);
                });
            },
            remove() {
                this.isDeleting = true;
                fetch('{{ route('product-images.store') }}/' + this.selected.id + '?_method=DELETE', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'x-csrf-token': '{{ csrf_token() }}',
                    }
                }).then(response => response.text()).then(response => {
                    this.reset();
                    this.$dispatch('product-image-removed', this.selected.id);
                });
            },
            reset() {
                this.$refs.form.reset();
                this.selected = {
                    id: null,
                    product_id: null,
                    image_name: null,
                    image_url: null,
                    created_at: null,
                    updated_at: null,
                };
                this.isUploading = false;
                this.isDeleting = false;
            },
        }
    }
</script>
