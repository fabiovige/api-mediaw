<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\AuthServices;
use App\Services\PagarmeGateway;
use App\Services\PaymentGatewayInterface;
use App\Services\PaymentGatewayService;
use Core\Domain\Factory\CompanyFactoryInterface;
use Core\Domain\Factory\UserFactoryInterface;
use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\UuidGeneratorInterface;
use Core\Domain\Repositories\CompanyRepositoryInterface;
use Core\Domain\Repositories\UserRepositoryInterface;
use Core\Infra\Factory\EloquentCompanyFactory;
use Core\Infra\Factory\EloquentUserFactory;
use Core\Infra\Repositories\CompanyRepository;
use Core\Infra\Repositories\UserRepository;
use Core\Infra\Utils\LaravelHasher;
use Core\Infra\Utils\RamseyUuidGenerator;
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
            return new PagarmeGateway();
        });

        // PaymentGatewayService
        $this->app->bind(PaymentGatewayService::class, function ($app) {
            return new PaymentGatewayService($app->make(PaymentGatewayInterface::class));
        });

        // Company - injeção de dependencia do repositorio
        $this->app->bind(CompanyRepositoryInterface::class,CompanyRepository::class);
        $this->app->bind(CompanyFactoryInterface::class,EloquentCompanyFactory::class);

        // User - injeção de dependencia do repositorio
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(UserFactoryInterface::class,EloquentUserFactory::class);

        // Utils - dependencias externas
        $this->app->bind(UuidGeneratorInterface::class, RamseyUuidGenerator::class);
        $this->app->bind(HasherInterface::class, LaravelHasher::class);
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
