<?php

namespace App\Http\Controllers\Api;

use App\Contracts\IImageService;
use App\Contracts\Repository\IProductRepository;
use App\Enums\Enum\StatusProductEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiProductRequest;
use App\Http\Requests\UpdateApiProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Ypk;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{

    public function __construct(private IProductRepository $repository, private IImageService $imageService)
    {

    }

    #[OA\Get(
        path: '/api/product/all/publish',
        summary: 'Get all published products',
        tags: ['Product'],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkId', type: 'string'),
                    new OA\Property(property: 'productName', type: 'string'),
                    new OA\Property(property: 'productCost', type: 'number'),
                    new OA\Property(property: 'productInfo', type: 'string'),
                    new OA\Property(property: 'isProduct', type: 'boolean'),
                    new OA\Property(property: 'photoPath', type: 'string', nullable: true),
                    new OA\Property(property: 'photoUrl', type: 'string', nullable: true),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'statusProductId', type: 'string'),
                ])
            )),
        ]
    )]
    public function getAllPublish()
    {
        return $this->repository->getByStatus(StatusProductEnum::Publish->value);

    }

    #[OA\Get(
        path: '/api/product/all/editing',
        summary: 'Get all editing products',
        tags: ['Product'],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkId', type: 'string'),
                    new OA\Property(property: 'productName', type: 'string'),
                    new OA\Property(property: 'productCost', type: 'number'),
                    new OA\Property(property: 'productInfo', type: 'string'),
                    new OA\Property(property: 'isProduct', type: 'boolean'),
                    new OA\Property(property: 'photoPath', type: 'string', nullable: true),
                    new OA\Property(property: 'photoUrl', type: 'string', nullable: true),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'statusProductId', type: 'string'),
                ])
            )),
        ]
    )]
    public function getAllEditing()
    {
        return $this->repository->getByStatus(StatusProductEnum::Editing->value);
    }

    #[OA\Get(
        path: '/api/product/byYpk/{ypk}',
        summary: 'Get products by YPK',
        tags: ['Product'],
        parameters: [
            new OA\Parameter(name: 'ypk', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkId', type: 'string'),
                    new OA\Property(property: 'productName', type: 'string'),
                    new OA\Property(property: 'productCost', type: 'number'),
                    new OA\Property(property: 'productInfo', type: 'string'),
                    new OA\Property(property: 'isProduct', type: 'boolean'),
                    new OA\Property(property: 'photoPath', type: 'string', nullable: true),
                    new OA\Property(property: 'photoUrl', type: 'string', nullable: true),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'statusProductId', type: 'string'),
                ])
            )),
        ]
    )]
    public function getByYpk(Ypk $ypk)
    {
        return new ProductCollection($ypk->products()->get());
    }

    #[OA\Get(
        path: '/api/product/{product}',
        summary: 'Get product by ID',
        tags: ['Product'],
        parameters: [
            new OA\Parameter(name: 'product', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkId', type: 'string'),
                    new OA\Property(property: 'productName', type: 'string'),
                    new OA\Property(property: 'productCost', type: 'number'),
                    new OA\Property(property: 'productInfo', type: 'string'),
                    new OA\Property(property: 'isProduct', type: 'boolean'),
                    new OA\Property(property: 'photoPath', type: 'string', nullable: true),
                    new OA\Property(property: 'photoUrl', type: 'string', nullable: true),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'statusProductId', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Product not found', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(Product $product)
    {
        return new ProductResource($product);
    }

    #[OA\Delete(
        path: '/api/product/{product}',
        summary: 'Delete product by ID',
        security: [['bearerAuth' => []]],
        tags: ['Product'],
        parameters: [
            new OA\Parameter(name: 'product', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Deleted', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Product not found', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function destroy(Product $product)
    {
        $product->delete();
        return response(status: 204);
    }

    #[OA\Post(
        path: '/api/product',
        summary: 'Create a product',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'ProductName', type: 'string'),
                    new OA\Property(property: 'YpkId', type: 'string'),
                    new OA\Property(property: 'StatusProductId', type: 'string'),
                    new OA\Property(property: 'ProductCost', type: 'string'),
                    new OA\Property(property: 'ProductInfo', type: 'string'),
                    new OA\Property(property: 'IsProduct', type: 'boolean'),
                    new OA\Property(property: 'Photo', type: 'string', format: 'binary'),
                    new OA\Property(property: 'Address', type: 'string'),
                ]
            )
        ),
        tags: ['Product'],
        responses: [
            new OA\Response(response: 201, description: 'Created', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                ]
            )),
        ]
    )]
    public function store(StoreApiProductRequest $request)
    {
        $product_data = $request->validated();


        $product_data['user_id'] = $request->user()->id;
        if ($request->hasFile("Photo")) {
            $product_data['photo_path'] = $this->imageService
                ->uploadImage($request->file("Photo"), "products");
        }

        /** @var Product $new_product */
        $new_product = $request->user()->products()->create($product_data);
        return response($new_product->id, 201);
    }

    #[OA\Put(
        path: '/api/product/update',
        summary: 'Update product by ID',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ProductName', type: 'string'),
                    new OA\Property(property: 'YpkId', type: 'string'),
                    new OA\Property(property: 'StatusProductId', type: 'string'),
                    new OA\Property(property: 'ProductCost', type: 'string'),
                    new OA\Property(property: 'ProductInfo', type: 'string'),
                    new OA\Property(property: 'IsProduct', type: 'boolean'),
                    new OA\Property(property: 'Photo', type: 'string', format: 'binary'),
                    new OA\Property(property: 'Address', type: 'string'),
                ]
            )
        ),
        tags: ['Product'],
        responses: [
            new OA\Response(response: 204, description: 'Updated', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Product not found', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function update(UpdateApiProductRequest $request)
    {
        $current_product = Product::findOrFail($request->id);
        $product_data = $request->validated();


        $product_data['user_id'] = $request->user()->id;
        if ($request->hasFile("Photo")) {
            $product_data['photo_path'] = $this->imageService
                ->uploadImage($request->file("Photo"), "products");
        }


        $current_product->update($product_data);
        return response(status: 204);
    }


}
