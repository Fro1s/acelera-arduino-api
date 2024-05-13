<?php

namespace App\Http\Controllers\User;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\RestoreUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use Exception;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $this->userService->store($request->validated());
            return ReturnApi::success($data, 'Usuário cadastrado com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao cadastrar usuário', $ex->getCode() ?? 500);
        }
    }

    public function delete(DeleteUserRequest $request)
    {
        try {
            $data = $this->userService->delete($request->validated());
            return ReturnApi::success($data, 'Usuário deletado com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao deletar usuário!', $ex->getCode() ?? 500);
        }
    }

    public function restore(RestoreUserRequest $request)
    {
        try {
            $data = $this->userService->restore($request->validated());
            return ReturnApi::success($data, 'Usuário restaurado com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao restaurar usuário!', $ex->getCode() ?? 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $data = $this->userService->update($request->validated(), $request->route('id'));
            return ReturnApi::success($data, 'Usuário atualizado com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao atualizar usuário!', $ex->getCode() ?? 500);
        }
    }

    public function show(ShowUserRequest $request)
    {
        try {
            $data = $this->userService->show($request->validated());
            return ReturnApi::success($data, 'Usuário listado com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao listar usuário!', $ex->getCode() ?? 500);
        }
    }

    public function index(IndexUserRequest $request)
    {
        try {
            $data = $this->userService->index($request->validated());
            return ReturnApi::success($data, 'Usuários listados com sucesso!');
        } catch (Exception $ex) {
            throw new ApiException($ex->getMessage() ?? 'Erro ao listar usuários!', $ex->getCode() ?? 500);
        }
    }
}
