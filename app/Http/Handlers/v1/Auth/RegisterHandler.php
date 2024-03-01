<?php

namespace App\Http\Handlers\v1\Auth;

use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Services\v1\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RegisterHandler
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->authService->createUserAndStoreEmail($request);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => 'Registro exitoso. Por favor, verifica tu correo electrónico para completar el proceso de registro.'
        ], Response::HTTP_CREATED);
    }
}
