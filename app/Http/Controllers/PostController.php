<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//*index
class PostController extends Controller
{
    public function index(){
        {
            $allPosts = [
                [
                    'id' => 1,
                    'title' => 'JavaScript',
                    'description' => 'hello this is JavaScript post',
                    'posted_by' => 'Mohamed',
                    'created_at' => '2023-01-28 18:05:00',
                ],

                [
                    'id' => 2,
                    'title' => 'NodeJS',
                    'description' => 'hello this is NodeJS post',
                    'posted_by' => 'Omar',
                    'created_at' => '2023-01-30 18:15:00',
                ],
            ];
            return view('posts.index',[
            'posts' => $allPosts,
        ]);
        }
    }
    public function create(){
        return view(view:'posts.create');
    }
    public function store(){
        return 'submitted';
    }

    //*show
    public function show($postId){
        $allPosts = [
            [
                'id' => 1,
                'title' => 'JavaScript',
                'description' => 'hello this is JavaScript post',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-01-28 18:05:00',
            ],

            [
                'id' => 2,
                'title' => 'NodeJS',
                'description' => 'hello this is NodeJS post',
                'posted_by' => 'Omar',
                'created_at' => '2023-01-30 18:15:00',
            ],
        ];

        $selectedPost = '';
        foreach ($allPosts as $post)
        if ($post['id'] == $postId){
            $selectedPost =$post;
        }
        return view('posts.show', ['post' =>$selectedPost]);
    }

    //*edit
    public function edit($postId)
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'JavaScript',
                'description' => 'hello this is JavaScript post',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-01-28 18:05:00',
            ],

            [
                'id' => 2,
                'title' => 'NodeJS',
                'description' => 'hello this is NodeJS post',
                'posted_by' => 'Omar',
                'created_at' => '2023-01-30 18:15:00',
            ],
        ];


        $selectedPost = '';
        foreach ($allPosts as $post) {
            if ($post['id'] == $postId) {
                $selectedPost = $post;
            }
        }
        return view('posts.edit', [
            'post' => $selectedPost
        ]);
    }

}
