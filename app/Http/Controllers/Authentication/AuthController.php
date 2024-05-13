<?php

namespace App\Http\Controllers\Authentication;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function login(LoginRequest $request) 
    {
        try{
            $data = $this->authService->login($request->validated());
            return ReturnApi::success($data, 'Usuário logado com sucesso!');
        }catch (\Exception $e){
            throw new ApiException($e->getMessage() ?? 'Erro ao realizar login', $e->getCode() ?? 500);        
        }
    }
}