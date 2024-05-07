<?php

namespace App\Providers;

use App\Services\AuthServices;
use Core\Application\Services\PaymentGatewayService;
//use App\Services\PagarmeGateway;
//use App\Services\PaymentGatewayInterface;
//use App\Services\PaymentGatewayService;

use Core\Domain\Persistence\CompanyOrmInterface;
use Core\Domain\Persistence\UserOrmInterface;

use Core\Domain\Interfaces\HasherInterface;
use Core\Domain\Interfaces\PaymentGatewayInterface;
use Core\Domain\Interfaces\TransactionalInterface;
use Core\Domain\Interfaces\UuidGeneratorInterface;
use Core\Domain\Persistence\CompanyAuthenticationOrmInterface;
use Core\Domain\Persistence\CompanyGatewayOrmInterface;
use Core\Domain\Repositories\CompanyRepositoryInterface;
use Core\Domain\Repositories\CompanyAuthenticationRepositoryInterface;
use Core\Domain\Repositories\CompanyGatewayRepositoryInterface;
use Core\Domain\Repositories\UserRepositoryInterface;

use Core\Infra\Payment\PagarmeGateway;
use Core\Infra\Persistence\EloquentCompany;
use Core\Infra\Persistence\EloquentCompanyAuthentication;
use Core\Infra\Persistence\EloquentCompanyGateway;
use Core\Infra\Persistence\EloquentTransactional;
use Core\Infra\Persistence\EloquentUser;
use Core\Infra\Repositories\CompanyAuthenticationRepository;
use Core\Infra\Repositories\CompanyGatewayRepository;
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
        // PaymentGatewayService
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            return new PagarmeGateway();
        });

        $this->app->bind(PaymentGatewayService::class, function ($app) {
            return new PaymentGatewayService($app->make(PaymentGatewayInterface::class));
        });

        // Company - injeção de dependencia do repositorio
        $this->app->bind(CompanyRepositoryInterface::class,CompanyRepository::class);

        // User - injeção de dependencia do repositorio
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);

        // Utils - dependencias externas
        $this->app->bind(UuidGeneratorInterface::class, RamseyUuidGenerator::class);
        $this->app->bind(HasherInterface::class, LaravelHasher::class);

        // Domain/Interfaces - dependencias externas
        $this->app->bind(TransactionalInterface::class, EloquentTransactional::class);

        // Company Authentication
        $this->app->bind(CompanyAuthenticationRepositoryInterface::class, CompanyAuthenticationRepository::class);

        // Company gateway
        $this->app->bind(CompanyGatewayRepositoryInterface::class, CompanyGatewayRepository::class);

        // ORM - Eloquent
        $this->app->bind(CompanyOrmInterface::class,EloquentCompany::class);
        $this->app->bind(CompanyGatewayOrmInterface::class,EloquentCompanyGateway::class);
        $this->app->bind(CompanyAuthenticationOrmInterface::class,EloquentCompanyAuthentication::class);
        $this->app->bind(UserOrmInterface::class,EloquentUser::class);
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
