<?php


namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/posts",
     *      operationId="getPostsList",
     *      tags={"Posts"},
     *      summary="Get list of posts",
     *      description="Returns list of posts",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *      ),
     *      @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function index(Request $request)
    {
        $tag = $request->query('tag');

        if ($tag) {
            $posts = $this->service->getByTag($tag);
        } else {
            $posts = $this->service->getAll();
        }

        return response()->json($posts);
    }

    /**
     * @OA\Post(
     *      path="/api/posts",
     *      operationId="storePost",
     *      tags={"Posts"},
     *      summary="Store a new post",
     *      description="Stores a new post in the database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Post created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *      ),
     *      @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(PostsRequest $request)
    {
        try {
            $data = $request->validated();
            $post = $this->service->create($data);

            return response()->json(['post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create post'], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/posts/{id}",
     *      operationId="getPostById",
     *      tags={"Posts"},
     *      summary="Get post by ID",
     *      description="Returns a single post by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the post",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *      ),
     *      @OA\Response(response=404, description="Post not found")
     * )
     */
    public function show($id)
    {
        $post = $this->service->getById($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    /**
     * @OA\Put(
     *      path="/api/posts/{id}",
     *      operationId="updatePost",
     *      tags={"Posts"},
     *      summary="Update an existing post",
     *      description="Updates a post in the database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the post",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Post updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *      ),
     *      @OA\Response(response=404, description="Post not found")
     * )
     */
    public function update(PostsRequest $request, $id)
    {
        $data = $request->validated();
        $post = $this->service->update($id, $data);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    /**
     * @OA\Delete(
     *      path="/api/posts/{id}",
     *      operationId="deletePost",
     *      tags={"Posts"},
     *      summary="Delete a post",
     *      description="Deletes a post from the database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the post",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=204, description="Post deleted successfully"),
     *      @OA\Response(response=404, description="Post not found")
     * )
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json(null, 204);
    }
}
