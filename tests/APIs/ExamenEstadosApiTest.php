<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExamenEstado;

class ExamenEstadosApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_examen_estados()
    {
        $examenEstados = factory(ExamenEstado::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/examen_estados', $examenEstados
        );

        $this->assertApiResponse($examenEstados);
    }

    /**
     * @test
     */
    public function test_read_examen_estados()
    {
        $examenEstados = factory(ExamenEstado::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/examen_estados/'.$examenEstados->id
        );

        $this->assertApiResponse($examenEstados->toArray());
    }

    /**
     * @test
     */
    public function test_update_examen_estados()
    {
        $examenEstados = factory(ExamenEstado::class)->create();
        $editedExamenEstados = factory(ExamenEstado::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/examen_estados/'.$examenEstados->id,
            $editedExamenEstados
        );

        $this->assertApiResponse($editedExamenEstados);
    }

    /**
     * @test
     */
    public function test_delete_examen_estados()
    {
        $examenEstados = factory(ExamenEstado::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/examen_estados/'.$examenEstados->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/examen_estados/'.$examenEstados->id
        );

        $this->response->assertStatus(404);
    }
}
