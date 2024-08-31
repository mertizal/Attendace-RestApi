<?php

namespace App\Http\Controllers;

use App\Models\UserGeni;
use App\Policies\UserGeniPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;

class UserGeniController extends Controller
{
    // use DisableAuthorization;
    protected $model = UserGeni::class;
    protected $policiy = UserGeniPolicy::class;


     /**
     * Retrieves currently authenticated user based on the guard.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }
    
} 