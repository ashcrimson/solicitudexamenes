<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\DocumentoTipo;

class DocumentoTipoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_documento_tipo()
    {
        $documentoTipo = factory(DocumentoTipo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/documento_tipos', $documentoTipo
        );

        $this->assertApiResponse($documentoTipo);
    }

    /**
     * @test
     */
    public function test_read_documento_tipo()
    {
        $documentoTipo = factory(DocumentoTipo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/documento_tipos/'.$documentoTipo->id
        );

        $this->assertApiResponse($documentoTipo->toArray());
    }

    /**
     * @test
     */
    public function test_update_documento_tipo()
    {
        $documentoTipo = factory(DocumentoTipo::class)->create();
        $editedDocumentoTipo = factory(DocumentoTipo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/documento_tipos/'.$documentoTipo->id,
            $editedDocumentoTipo
        );

        $this->assertApiResponse($editedDocumentoTipo);
    }

    /**
     * @test
     */
    public function test_delete_documento_tipo()
    {
        $documentoTipo = factory(DocumentoTipo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/documento_tipos/'.$documentoTipo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/documento_tipos/'.$documentoTipo->id
        );

        $this->response->assertStatus(404);
    }
}
