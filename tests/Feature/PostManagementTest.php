<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Post;

class PostManagementTest extends TestCase
{
    use RefreshDatabase; //esto es un trait , Es para evitar migrar la tabla y usal la tabla en memoria

    /** @test */
    public function list_of_post_can_be_retrived()
    {
        $this->withoutExceptionHandling();


        Post::factory()->count(3)->make();

        $response = $this->get('/posts'); //llamo a la ruta del controlador
        $response->assertOK();
        $posts = Post::all();

        $response->assertViewIs('posts.index'); //comprueba que se retorne una vista
        $response->assertViewHas('posts', $posts); //comprueba que en la vista se encuentren los datos fabricados (Comprueban que existan las variables pasadas).
    }


    /** @test */
    public function a_post_can_be_retrived()
    {
        $this->withoutExceptionHandling();


        $post = Post::factory()->create();


        $response = $this->get('/posts/' . $post->id); //llamo a la ruta del controlador

        $response->assertOK();
        $post = Post::first();

        $response->assertViewIs('posts.show'); //comprueba que se retorne una vista
        $response->assertViewHas('post', $post); //comprueba que en la vista se encuentren los datos fabricados (Comprueban que existan las variables pasadas).

    }

    /** @test */
    public function a_post_can_be_created()
    {

        $this->withoutExceptionHandling(); //descativar las excepciones que atrpa el test, es para ver más datos por consola

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => 'Test Content'
        ]);

        
        $this->assertCount(1, Post::all());

        $post = Post::first();
        $this->assertEquals($post->title, 'Test Title');
        $this->assertEquals($post->content, 'Test Content');

        $response->assertRedirect('/posts/' . $post->id);
    }

    /** @test */
    public function post_title_is_required()
    {


        $response = $this->post('/posts', [
            'title' => '',
            'content' => 'Test Content'
        ]);

        $response->assertSessionHasErrors(['title']);


    }
    /** @test */
    public function post_content_is_required()
    {


        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => ''
        ]);

        $response->assertSessionHasErrors(['content']);


    }
    
    

     /** @test */
     public function a_post_can_be_updated()
     {
 
         $this->withoutExceptionHandling(); //descativar las excepciones que atrpa el test, es para ver más datos por consola
         
         $post = Post::factory()->create();
 
         $response = $this->put('/posts/'. $post->id, [
             'title' => 'Test Title',
             'content' => 'Test Content'
         ]);
 
         
         $this->assertCount(1, Post::all());
 
         $post = $post->fresh(); //actuliaza el recurso sin tener que llamarlo nuevamete o crear otro objeto. recargamos el objeto con la nueva informacion.


         $this->assertEquals($post->title, 'Test Title');
         $this->assertEquals($post->content, 'Test Content');
 
         $response->assertRedirect('/posts/' . $post->id);
     }
     /** @test */
     public function a_post_can_be_deleted()
     {
 
         $this->withoutExceptionHandling(); //descativar las excepciones que atrpa el test, es para ver más datos por consola
         
         $post = Post::factory()->create();
 
         $response = $this->delete('/posts/'. $post->id);
 
         
         $this->assertCount(0, Post::all());
 
 
         $response->assertRedirect('/posts/');
     }

}
