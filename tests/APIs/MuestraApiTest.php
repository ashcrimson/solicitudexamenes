<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Muestra;

class MuestraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_muestra()
    {
        $muestra = factory(Muestra::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/muestras', $muestra
        );

        $this->assertApiResponse($muestra);
    }

    /**
     * @test
     */
    public function test_read_muestra()
    {
        $muestra = factory(Muestra::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/muestras/'.$muestra->id
        );

        $this->assertApiResponse($muestra->toArray());
    }

    /**
     * @test
     */
    public function test_update_muestra()
    {
        $muestra = factory(Muestra::class)->create();
        $editedMuestra = factory(Muestra::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/muestras/'.$muestra->id,
            $editedMuestra
        );

        $this->assertApiResponse($editedMuestra);
    }

    /**
     * @test
     */
    public function test_delete_muestra()
    {
        $muestra = factory(Muestra::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/muestras/'.$muestra->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/muestras/'.$muestra->id
        );

        $this->response->assertStatus(404);
    }
}
