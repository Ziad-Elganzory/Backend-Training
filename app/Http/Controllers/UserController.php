<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use UnexpectedValueException;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}
    public function index(): JsonResponse
    {
        try{

            $users = $this->userService->all();
            return response()->json($users);

        } catch(Exception $e){

            return response()->json([
                "error" => "Error occured during users fetching",
                "message" => $e->getMessage()
            ],400);

        }
    }

    public function store(Request $request): JsonResponse
    {
        try{
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed'
            ]);

            $user = $this->userService->create($data);
            if(!$user instanceof User ){
                throw new UnexpectedValueException('Failed to create user');
            }
            return response()->json([
                "success" => "User Created Successfully",
                "user" => $user
            ],200);
        } catch(Exception $e){
            return response()->json([
                "error" => "Error occured during user creating",
                "message" => $e->getMessage()
            ],400);
        }
    }
    public function show(int $id): JsonResponse
    {
        try{
            $user = $this->userService->find($id);

            if (!$user instanceof User) {
                throw new ModelNotFoundException('User not found');
            }
            return response()->json([
                "success" => "User Found",
                "user" => $user
            ],200);
        }catch(Exception $e){
            return response()->json([
                "error" => "Error occured during user creating",
                "message" => $e->getMessage()
            ],400);
        }

    }
    public function update(Request $request, int $id): JsonResponse
    {
        try{
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,
                'password' => 'sometimes|confirmed'
            ]);
            $user = $this->userService->update($data,$id);
            if($user <= 0){
                throw new UnexpectedValueException('Failed to update user');
            }
            return response()->json([
                "success" => "User {$id} Updated Successfully",
            ],200);
        }catch(Exception $e){
            return response()->json([
                "error" => "Error occured during user update",
                "message" => $e->getMessage()
            ],400);
        }
    }
    public function destroy(int $id): JsonResponse
    {
        try{
            $result = $this->userService->delete($id);
            Log::info($result);
            if($result <= 0){
                throw new UnexpectedValueException('Failed Deleting User');
            }
            return response()->json([
                "success" => "User {$id} deleted successfully"
            ]);
        } catch(Exception $e){
            return response()->json([
                "error" => "Error occured during user update",
                "message" => $e->getMessage()
            ],400);
        }
    }

    public function paginated(Request $request)
    {
        try{

            $users = $this->userService->paginated($request->query('perPage',10));
            return response()->json($users->items());

        } catch(Exception $e){

            return response()->json([
                "error" => "Error occured during users fetching",
                "message" => $e->getMessage()
            ],400);

        }
    }
}
