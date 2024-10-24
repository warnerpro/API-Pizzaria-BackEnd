<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse; // Importa a classe JsonResponse para tipagem
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    /**
     * Exibe uma lista de usuários.
     */
    public function index(): JsonResponse
    {
        // Recupera todos os usuários com paginação
        $users = User::select('id', 'name', 'email', 'created_at')->paginate(10);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuários encontrados!',
            'users' => $users // Corrigido para plural
        ]);
    }

    /**
     * Exibe o usuário logado.
     */
    public function me(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'status' => 200,
            'message' => 'Usuário logado!',
            'usuario' => $user
        ]);
    }

    /**
     * Armazena um novo usuário.
     */
    public function store(UserCreateRequest $request): JsonResponse
    {
        $data = $request->validated(); // Garante que apenas dados válidos sejam processados

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json([
            'status' => 201, // Alterado para 201 para indicar que o recurso foi criado
            'mensagem' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Exibe um usuário específico.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null // Corrigido para null se não encontrado
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Mostra o formulário de edição de um usuário.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        
        // Corrigido para passar a variável correta
        return view('usuario.editar', compact('user'));
    }

    /**
     * Atualiza um usuário específico.
     */
    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        $data = $request->validated(); // Garante que apenas dados válidos sejam processados

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null // Corrigido para null se não encontrado
            ]);
        }

        $user->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Remove um usuário específico.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null // Corrigido para null se não encontrado
            ]);
        }

        $user->delete(); // Não é necessário passar o ID aqui, já que o objeto foi encontrado

        return response()->json([
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!'
        ]);
    }
}
