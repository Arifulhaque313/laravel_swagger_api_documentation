<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends BaseController
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    // Fetch all posts
    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        return $this->successResponse($posts, "Posts fetched successfully");
    }

    // Create a new post
    public function store(CreateRequest $request): JsonResponse
    {
        $post = $this->postService->createPost($request->validated());

        if ($post) {
            return $this->successResponse($post, 'Post created successfully!', 201);
        }

        return $this->errorResponse('Post creation failed!', 500);
    }

    // Fetch a single post
    public function show(Post $post): JsonResponse
    {
        return $this->successResponse($post);
    }

    // Update a post
    public function update(UpdateRequest $request, Post $post): JsonResponse
    {
        $updatedPost = $this->postService->updatePost($post, $request->validated());

        if ($updatedPost) {
            return $this->successResponse($updatedPost, 'Post updated successfully!');
        }

        return $this->errorResponse('Post update failed!', 500);
    }

    // Delete a post
    public function destroy(Post $post): JsonResponse
    {
        $deleted = $this->postService->deletePost($post);

        if ($deleted) {
            return $this->successResponse(null, 'Post deleted successfully!');
        }

        return $this->errorResponse('Post deletion failed!', 500);
    }
}