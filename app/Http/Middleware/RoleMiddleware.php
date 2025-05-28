<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $permissions)
    {
        // Odredi trenutnu ulogu korisnika
        $role = Auth::check() ? Auth::user()->role : 'guest';

        // Definiraj dozvole po ulozi
        $rolePermissions = [
            'guest' => [
                'product.read',
                'category.read',
            ],
            'reader' => [
                'product.read',
                'category.read',
                'color.read',
                'customers.read',
            ],
            'author' => [
                'product.read', 'product.create',
                'category.read', 'category.create',
                'color.read', 'color.create',
                'customers.read', 'customers.create',
            ],
            'admin' => [
                'product.read', 'product.create', 'product.update', 'product.delete',
                'category.read', 'category.create', 'category.update', 'category.delete',
                'color.read', 'color.create', 'color.update', 'color.delete',
                'customers.read', 'customers.create', 'customers.update', 'customers.delete',
            ],
        ];

        // Jedna ruta može tražiti više dozvola, npr. 'product.create|product.update'
        $requiredPermissions = explode('|', $permissions);

        // Provjeri barem jednu odgovarajuću dozvolu
        foreach ($requiredPermissions as $perm) {
            if (in_array($perm, $rolePermissions[$role])) {
                return $next($request);
            }
        }

        abort(403, 'Nemate potrebne ovlasti.');
    }


}
