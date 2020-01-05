<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class TestingController extends Controller
{
    public function index(){
        $tittle = 'Animals';
        $animals = ['Perro', 'Gato', 'Tigre'];

        return view('test.index', array(
            'tittle' => $tittle,
            'animals' => $animals
        ));
    }

    public function testORM(){
        $posts = Post::all();
        
        //muestra los metodos Eloquent de POST
        //var_dump($posts);
        /*

        //MUESTRA TODOS LOS POST 
        foreach($posts as $post){
            echo "<h1>".$post->title."</h1>";
            echo "<span style='color:gray'>{$post->user->name} - {$post->category->name}</span>";
            echo "<p>".$post->content."</p>";
            echo "<hr>";
        }*/

        //MUESTRA LOS POST CLASIFICADOS POR CATEGORIAS
        $categories = Category::all();

        foreach($categories as $category){
            echo "<h1>{$category->name}</h1>";

            foreach($category->posts as $post){
                echo "<h3>".$post->title."</h3>";
                echo "<span style='color:gray'>{$post->user->name} - {$post->category->name}</span>";
                echo "<p>".$post->content."</p>";
            }

            echo "<hr>";
        }
        die();
    }
}
