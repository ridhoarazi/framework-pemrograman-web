<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_posts_list(): void
    {
        Post::factory()->count(3)->create();

        $response = $this->get('/posts');

        $response->assertOk()
                ->assertSee('Semua Post')
                ->assertViewHas('posts', fn ($posts) => $posts->count() === 3);
    }

    public function test_authenticated_user_can_create_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Judul Test',
            'body'  => 'Isi test body',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title'   => 'Judul Test',
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_cannot_create_post(): void
    {
        $response = $this->post('/posts', [
            'title' => 'Judul Test',
            'body'  => 'Isi test body',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_title_is_required_when_creating_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => '',
            'body'  => 'Isi test body',
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_user_can_delete_own_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this->actingAs($user)->delete("/posts/{$post->id}");

        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_user_cannot_delete_other_user_post(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $post  = Post::factory()->for($userA)->create();

        $response = $this->actingAs($userB)->delete("/posts/{$post->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }
}
