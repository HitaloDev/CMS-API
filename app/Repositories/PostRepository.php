<?php

namespace App\Repositories;

use App\Models\Posts;

class PostRepository
{
    protected Posts $post;

    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post->all();
    }

    public function getByTag($tag)
    {
        return $this->post->whereJsonContains('tags', $tag)->get();
    }

    public function getById($id)
    {
        return $this->post->find($id);
    }

    public function create(array $data)
    {
        return $this->post->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->post->find($id);
        if ($post) {
            $post->update($data);
            return $post;
        }
        return null;
    }

    public function delete($id)
    {
        $post = $this->post->find($id);
        if ($post) {
            $post->delete();
            return true;
        }
        return false;
    }

    public function restore($id)
    {
        $post = $this->post->onlyTrashed()->find($id);
        if ($post) {
            $post->restore();
            return $post;
        }
        return null;
    }

    public function forceDelete($id)
    {
        $post = $this->post->onlyTrashed()->find($id);
        if ($post) {
            $post->forceDelete();
            return true;
        }
        return false;
    }
}
