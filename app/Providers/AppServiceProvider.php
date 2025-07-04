<?php

namespace App\Providers;

use App\Interfaces\Admin\AdminInterface;
use App\Interfaces\Admin\AuthInterface as AdminAuthInterface;
use App\Interfaces\Admin\Category\CategoryInterface;
use App\Interfaces\Admin\PaymentMethod\PaymentMethodInterface;
use App\Interfaces\Merchant\AuthInterface as MerchantAuthInterface;
use App\Interfaces\Merchant\MerchantCategoryInterface;
use App\Interfaces\Merchant\ProductInterface as MerchantProductInterface;
use App\Interfaces\Merchant\ShopInterface as MerchantShopInterface;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Interfaces\User\AuthInterface as UserAuthInterface;
use App\Interfaces\User\OrderInterface;
use App\Interfaces\User\ProductInterface as UserProductInterface;
use App\Interfaces\User\ShopInterface as UserShopInterface;
use App\Interfaces\User\UserInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AuthRepository as AdminAuthRepository;
use App\Repositories\Admin\PaymentMethod\PaymentMethodRepository;
use App\Repositories\Merchant\AuthRepository as MerchantAuthRepository;
use App\Repositories\Merchant\MerchantCategoryRepository;
use App\Repositories\Merchant\ProductRepository as MerchantProductRepository;
use App\Repositories\Merchant\ShopRepository as MerchantShopRepository;
use App\Repositories\User\AuthRepository as UserAuthRepository;
use App\Repositories\User\orderRepository;
use App\Repositories\User\ProductRepository as UserProductRepository;
use App\Repositories\User\ShopRepository as UserShopRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserAuthInterface::class, UserAuthRepository::class);
        $this->app->bind(MerchantAuthInterface::class, MerchantAuthRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(MerchantCategoryInterface::class, MerchantCategoryRepository::class);
        $this->app->bind(MerchantProductInterface::class, MerchantProductRepository::class);
        $this->app->bind(UserShopInterface::class, UserShopRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserProductInterface::class, UserProductRepository::class);
        $this->app->bind(AdminAuthInterface::class, AdminAuthRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodRepository::class);
        $this->app->bind(OrderInterface::class, orderRepository::class);
        $this->app->bind(MerchantShopInterface::class, MerchantShopRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
