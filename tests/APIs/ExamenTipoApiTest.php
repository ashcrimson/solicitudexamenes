<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExamenTipo;

class ExamenTipoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_examen_tipo()
    {
        $examenTipo = factory(ExamenTipo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/examen_tipos', $examenTipo
        );

        $this->assertApiResponse($examenTipo);
    }

    /**
     * @test
     */
    public function test_read_examen_tipo()
    {
        $examenTipo = factory(ExamenTipo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/examen_tipos/'.$examenTipo->id
        );

        $this->assertApiResponse($examenTipo->toArray());
    }

    /**
     * @test
     */
    public function test_update_examen_tipo()
    {
        $examenTipo = factory(ExamenTipo::class)->create();
        $editedExamenTipo = factory(ExamenTipo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/examen_tipos/'.$examenTipo->id,
            $editedExamenTipo
        );

        $this->assertApiResponse($editedExamenTipo);
    }

    /**
     * @test
     */
    public function test_delete_examen_tipo()
    {
        $examenTipo = factory(ExamenTipo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/examen_tipos/'.$examenTipo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/examen_tipos/'.$examenTipo->id
        );

        $this->response->assertStatus(404);
    }
}
