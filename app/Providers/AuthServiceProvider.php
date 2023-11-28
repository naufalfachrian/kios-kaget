<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ShippingAddress;
use App\Models\Tag;
use App\Models\TagGroup;
use App\Policies\ProductImagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ShippingAddressPolicy;
use App\Policies\TagGroupPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ShippingAddress::class => ShippingAddressPolicy::class,
        Product::class => ProductPolicy::class,
        ProductImage::class => ProductImagePolicy::class,
        Tag::class => TagPolicy::class,
        TagGroup::class => TagGroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
