<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Turns;

class TurnsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_turns_can_be_retrieved(): void
    {
        $this->withoutExceptionHandling();

        factory(Turns::class, 5)->create();

        $response = $this->get('/turns');

        $response->assertOk();

        $turns = Turns::all();

        $response->assertViewIs('Turns/Index');
        $response->assertViewHas('turns', $turns);
    }   

    /** @test */
    public function a_turn_can_be_retrieved(): void
    {
        $this->withoutExceptionHandling();

        $turn = factory(Turns::class)->create();

        $response = $this->get('/turns', $turn->id);

        $response->assertOk();

        $turn = Turns::first();

        $response->assertViewIs('Turns/Show');
        $response->assertViewHas('turn', $turn);
    }   

    /** @test */
    public function a_turn_can_be_created(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/turns', [
            'turn' => '10:00', 
        ]);

        $this->assertCount(1, Turns::all());

        $turn = Turns::first();

        $this->assertEquals($turn->turn, '10:00');
        $this->assertEquals($turn->status, true);

        $response->assertRedirect('/turns/' . $turn->id);
    }    
    
    /** @test */
    public function an_created_turn_turn_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->post('/turns', [
            'turn' => '10:00', 
        ]);

        $response->assertSessionHasErrors(['turn']);
    } 

    /** @test */
    public function a_turn_can_be_updated(): void
    {
        $this->withoutExceptionHandling();

        $turn = factory(Turns::class)->create();

        $response = $this->put('/turns', $turn->id, [
            'turn' => '10:00', 
            'status' => false,
        ]);

        $this->assertCount(1, Turns::all());

        $turn = Turns::fresh();

        $this->assertEquals($turn->turn, '10:00');
        $this->assertEquals($turn->status, false);

        $response->assertRedirect('/turns/' . $turn->id);
    }   
    
    /** @test */
    public function an_updated_turn_turn_is_required(): void
    {    
        $this->withoutExceptionHandling();

        $response = $this->put('/turns', [
            'turn' => '', 
        ]);

        $response->assertSessionHasErrors(['turn']);
    }   

    /** @test */
    public function a_turn_can_be_assigned_to_movies(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }  

    /** @test */
    public function a_turn_can_be_deleted(): void
    {
        $this->withoutExceptionHandling();

        $turn = factory(Turns::class)->create();

        $response = $this->delete('/turns', $turn->id);

        $this->assertCount(0, Turns::all());

        $response->assertRedirect('/turns');
    }  
}
