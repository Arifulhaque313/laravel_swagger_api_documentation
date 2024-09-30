<?php
namespace App\Services;

use App\Models\Post;

class PostService
{
    // Get all posts
    public function getAllPosts()
    {
        return Post::all();
    }

    // Create a new post
    public function createPost(array $data)
    {
        return Post::create($data);
    }

    // Update a post
    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    // Delete a post
    public function deletePost(Post $post)
    {
        return $post->delete();
    }
}