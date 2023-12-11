<x-admin-layout>
    <x-admin-header>
        <x-slot name="title">
            {{ __('Orders') }}
        </x-slot>
        <x-slot name="right">
        </x-slot>
    </x-admin-header>

    <div>
        @if (count($orders) == 0)
            <x-hero-warning text="You don't have any tags"></x-hero-warning>
        @else
            <div class="gap-4 grid">
                @foreach ($orders as $order)
                    @php
                    $orderTotal = 0;
                    @endphp
                    <div class="bg-brand-white shadow sm:rounded-lg relative overflow-hidden p-6 gap-2 flex flex-col">
                        <span class="font-semibold text-lg text-brand-black leading-tight">{{ $order->shippingAddress->recipient_name }}</span>
                        <span class="font-normal text-md text-brand-black leading-tight">{{ $order->shippingAddress->address }}</span>
                        <span class="font-normal text-md text-brand-black leading-tight">{{ $order->shippingAddress->subDistrict->name }}, {{ $order->shippingAddress->district->name }}, {{ $order->shippingAddress->city->name }}</span>
                        <span class="font-normal text-md text-brand-black leading-tight">{{ $order->shippingAddress->province->name }}, {{ $order->shippingAddress->postal_code }}</span>
                        <span class="font-normal text-md italic text-brand-black leading-tight">{{ $order->shippingAddress->landmark ?? '-' }}</span>
                        <span class="font-semibold text-md text-brand-black leading-tight"><a href="https://wa.me/{{ $order->shippingAddress->phone_number }}" target="_blank">{{ $order->shippingAddress->phone_number }}</a></span>
                        <span class="font-normal text-md text-brand-black leading-tight">{{ $order->email }}</span>
                        <div class="not-prose relative rounded-xl overflow-hidden dark:bg-slate-800/25 mt-4">
                            <div style="background-position: 10px 10px;" class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]">
                            </div>
                            <div class="relative rounded-xl overflow-auto">
                                <div class="shadow-sm overflow-hidden my-8">
                                    <table class="border-collapse table-auto w-full text-sm">
                                        <thead>
                                        <tr>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Product') }}</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Qty') }}</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Total') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-slate-800">
                                        @foreach ($order->details as $detail)
                                        <tr>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                                <div class="flex flex-row">
                                                    <div class="basis-1/5">
                                                        @if (isset($detail->product))
                                                            <img class="rounded-lg aspect-square" src="{{ $detail->product->images[0]->image_url }}" alt="{{ $detail->product->images[0]->image_name }}">
                                                        @endif
                                                    </div>
                                                    <div class="basis-4/5">
                                                        <table class="table-auto">
                                                            <tbody>
                                                            <tr>
                                                                <td class="font-semibold">{{ __('Product ID') }}</td>
                                                                <td>{{ $detail->product_id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-semibold">{{ __('Product Name') }}</td>
                                                                <td>{{ $detail->product_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-semibold">{{ __('Product Price') }}</td>
                                                                <td>Rp {{ number_format($detail->product_price, 0, ',', '.') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-semibold">{{ __('Product Weight') }}</td>
                                                                <td>{{ number_format($detail->product_weight_in_grams, 0, ',', '.') }} grams</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                {{ $detail->quantity }} pcs
                                            </td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                                Rp {{ number_format($detail->quantity * $detail->product_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        @php
                                            $orderTotal += $detail->quantity * $detail->product_price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <th colspan="2" class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ __('Total') }}</th>
                                            <th>Rp {{ number_format($orderTotal, 0, ',', '.') }}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="absolute inset-0 pointer-events-none border border-black/5 rounded-xl dark:border-white/5">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
    </script>
</x-admin-layout>
