<div class="fixed right-0 bottom-0 m-6 gap-3 flex flex-col" x-data="notification" x-init="checkSessions" x-on:push-notification.window="notifications.push($event.detail)">
    <template x-for="notification in notifications">
        <div class="rounded-lg p-4 shadow-xl backdrop-blur-xl transform transition-all" :class="notification.color"
             x-data="{show: false}"
             x-show="show"
             x-init="$nextTick(() => { show = true });setTimeout(() => show = false, 5000);"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <span class="font-semibold text-sm text-white" x-text="notification.title"></span><br/>
            <span class="text-sm text-white" x-text="notification.text"></span><br/>
        </div>
    </template>
</div>

<script>
    function notification() {
        return {
            notifications: [],
            checkSessions() {
                setTimeout(() => {
                    const errors = JSON.parse('{!! $errors !!}');
                    console.log(errors)
                    Object.values(errors).every((value) => {
                        this.notifications.push({
                            title: 'Product failed to create!',
                            text: value,
                            color: 'bg-red-500/60',
                        });
                        return false;
                    });
                }, 100);
            }
        }
    }
</script>
