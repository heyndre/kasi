<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)
            ->orSearch('mobile_number', $request->email)
            ->first();
            // dd($user);
            
            // dd($user->birthday->format('dmY'));
            if ($user == null) {
                $user = User::whereHas('theStudent', function ($q) use ($request) {
                    $q->search('nim', $request->email);
                })
                ->first();
            }

            if ($user == null) {
                return null;
            }

            // dd($user);
    
            if ($user->role == 'MURID') {
                if (Hash::check($request->password, $user->password) || $request->password == $user->birthday->format('dmY')) {
                    return $user;
                }
            } else  {
                if (Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
