<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="Documentação da API gerada com Swagger",
 *      @OA\Contact(
 *          email="seu-email@dominio.com"
 *      ),
 *      @OA\License(
 *          name="MIT",
 *          url="https://opensource.org/licenses/MIT"
 *      )
 * )
 * 
 * @OA\Schema(
 *     schema="PostRequest",
 *     type="object",
 *     required={"title", "author", "content", "tags"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Título do post"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         type="string",
 *         description="Autor do post"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="Conteúdo do post"
 *     ),
 *     @OA\Property(
 *         property="tags",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Tags do post"
 *     )
 * )
 */
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
