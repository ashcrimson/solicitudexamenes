<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExamenGrupo;

class ExamenGrupoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_examen_grupo()
    {
        $examenGrupo = factory(ExamenGrupo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/examen_grupos', $examenGrupo
        );

        $this->assertApiResponse($examenGrupo);
    }

    /**
     * @test
     */
    public function test_read_examen_grupo()
    {
        $examenGrupo = factory(ExamenGrupo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/examen_grupos/'.$examenGrupo->id
        );

        $this->assertApiResponse($examenGrupo->toArray());
    }

    /**
     * @test
     */
    public function test_update_examen_grupo()
    {
        $examenGrupo = factory(ExamenGrupo::class)->create();
        $editedExamenGrupo = factory(ExamenGrupo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/examen_grupos/'.$examenGrupo->id,
            $editedExamenGrupo
        );

        $this->assertApiResponse($editedExamenGrupo);
    }

    /**
     * @test
     */
    public function test_delete_examen_grupo()
    {
        $examenGrupo = factory(ExamenGrupo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/examen_grupos/'.$examenGrupo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/examen_grupos/'.$examenGrupo->id
        );

        $this->response->assertStatus(404);
    }
}
