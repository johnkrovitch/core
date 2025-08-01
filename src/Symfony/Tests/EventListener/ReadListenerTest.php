<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Symfony\Tests\EventListener;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Resource\Factory\ResourceMetadataCollectionFactoryInterface;
use ApiPlatform\Metadata\Resource\ResourceMetadataCollection;
use ApiPlatform\Metadata\UriVariablesConverterInterface;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Symfony\EventListener\ReadListener;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ReadListenerTest extends TestCase
{
    public function testFetchOperation(): void
    {
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->once())->method('provide');
        $metadata = $this->createMock(ResourceMetadataCollectionFactoryInterface::class);
        $metadata->expects($this->once())->method('create')->with(\stdClass::class)->willReturn(new ResourceMetadataCollection(\stdClass::class, [
            new ApiResource(operations: [
                'operation' => new Get(),
            ]),
        ]));

        $request = new Request([], [], ['_api_operation_name' => 'operation', '_api_resource_class' => \stdClass::class]);
        $listener = new ReadListener($provider, $metadata);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                $request,
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }

    public function testCallProvider(): void
    {
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->once())->method('provide');
        $metadata = $this->createStub(ResourceMetadataCollectionFactoryInterface::class);
        $request = new Request([], [], ['_api_operation' => new Get(), '_api_operation_name' => 'operation', '_api_resource_class' => \stdClass::class]);
        $listener = new ReadListener($provider, $metadata);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                $request,
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }

    #[DataProvider('provideNonApiAttributes')]
    public function testNoCallProvider(...$attributes): void
    {
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->never())->method('provide');
        $metadata = $this->createStub(ResourceMetadataCollectionFactoryInterface::class);
        $metadata->method('create')->willReturn(new ResourceMetadataCollection(\stdClass::class));
        $listener = new ReadListener($provider, $metadata);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                new Request([], [], $attributes),
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }

    public static function provideNonApiAttributes(): array
    {
        return [
            ['_api_receive' => false, '_api_operation_name' => 'dummy'],
            [],
        ];
    }

    public function testReadFalse(): void
    {
        $operation = new Get(read: false);
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->once())->method('provide')->with($operation);
        $metadata = $this->createStub(ResourceMetadataCollectionFactoryInterface::class);
        $request = new Request([], [], ['_api_operation' => $operation, '_api_operation_name' => 'operation', '_api_resource_class' => \stdClass::class]);
        $listener = new ReadListener($provider, $metadata);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                $request,
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }

    public function testReadWithUriVariables(): void
    {
        $operation = new Get(uriVariables: ['id' => new Link(identifiers: ['id'])], class: \stdClass::class);
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->once())->method('provide')->with($operation->withRead(true), ['id' => 3]);
        $metadata = $this->createStub(ResourceMetadataCollectionFactoryInterface::class);
        $uriVariablesConverter = $this->createMock(UriVariablesConverterInterface::class);
        $uriVariablesConverter->expects($this->once())->method('convert')->with(['id' => '3'], \stdClass::class)->willReturn(['id' => 3]);
        $request = new Request([], [], ['_api_operation' => $operation, '_api_operation_name' => 'operation', '_api_resource_class' => \stdClass::class, 'id' => '3']);
        $listener = new ReadListener($provider, $metadata, $uriVariablesConverter);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                $request,
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }

    public function testReadNullWithPostMethod(): void
    {
        $operation = new Post(read: false);
        $provider = $this->createMock(ProviderInterface::class);
        $provider->expects($this->once())->method('provide')->with($operation);
        $metadata = $this->createStub(ResourceMetadataCollectionFactoryInterface::class);
        $request = new Request([], [], ['_api_operation' => new Post(), '_api_operation_name' => 'operation', '_api_resource_class' => \stdClass::class]);
        $request->setMethod('POST');
        $listener = new ReadListener($provider, $metadata);
        $listener->onKernelRequest(
            new RequestEvent(
                $this->createStub(HttpKernelInterface::class),
                $request,
                HttpKernelInterface::MAIN_REQUEST
            )
        );
    }
}
