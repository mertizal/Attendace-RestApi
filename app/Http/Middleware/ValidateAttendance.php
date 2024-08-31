<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;


class ValidateAttendance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->isMethod('get') || $request->isMethod('delete') || $request->isMethod('post') ) {
            return $next($request);
        }
        try {
            $validatedData = $request->validate([
                'user_genis_id' => 'required|exists:user_genis,id',
                'date' => 'required|date',
                'status' => 'required|string|max:255',
                'reason' => 'nullable|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'message' => 'Doğrulama hatası oluştu',
                'errors' => $e->validator->getMessageBag(),
            ], 422);
        }

        return $next($request);

    }
}
