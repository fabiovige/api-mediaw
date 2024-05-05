<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\AuthServices;
use App\Services\PagarmeGateway;
use App\Services\PaymentGatewayInterface;
use App\Services\PaymentGatewayService;
use Core\Infra\Factory\CompanyFactoryInterface;
use Core\Infra\Factory\EloquentCompanyFactory;
use Core\Infra\Repositories\CompanyRepository;
use Core\Infra\Repositories\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registre suas implementações de gateway de pagamento aqui
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            // Por padrão, vamos usar o Pagarme
            return new PagarmeGateway();
        });

        // Registre o serviço PaymentGatewayService
        $this->app->bind(PaymentGatewayService::class, function ($app) {
            return new PaymentGatewayService($app->make(PaymentGatewayInterface::class));
        });

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );

        $this->app->bind(
            CompanyFactoryInterface::class,
            EloquentCompanyFactory::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app->bind(
            AuthServices::class
        );
    }
}
