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

namespace ApiPlatform\Elasticsearch\Extension;

use ApiPlatform\Elasticsearch\Util\FieldDatatypeTrait;
use ApiPlatform\Metadata\HttpOperation;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Metadata\ResourceClassResolverInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

/**
 * Applies selected sorting while querying resource collection.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-sort.html
 *
 * @experimental
 *
 * @author Baptiste Meyer <baptiste.meyer@gmail.com>
 */
final class SortExtension implements RequestBodySearchCollectionExtensionInterface
{
    use FieldDatatypeTrait;

    public function __construct(PropertyMetadataFactoryInterface $propertyMetadataFactory, ResourceClassResolverInterface $resourceClassResolver, private readonly ?NameConverterInterface $nameConverter = null, private readonly ?string $defaultDirection = null)
    {
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->resourceClassResolver = $resourceClassResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(array $requestBody, string $resourceClass, ?Operation $operation = null, array $context = []): array
    {
        $orders = [];

        if (
            $operation
            && null !== ($defaultOrder = $operation->getOrder())
        ) {
            foreach ($defaultOrder as $property => $direction) {
                if (\is_int($property)) {
                    $property = $direction;
                    $direction = 'asc';
                }

                $orders[] = $this->getOrder($resourceClass, $property, $direction);
            }
        } elseif (null !== $this->defaultDirection) {
            $property = 'id';
            if ($operation instanceof HttpOperation) {
                $uriVariables = $operation->getUriVariables()[0] ?? null;
                $property = $uriVariables ? $uriVariables->getIdentifiers()[0] ?? 'id' : 'id';
            }

            $orders[] = $this->getOrder(
                $resourceClass,
                $property,
                $this->defaultDirection
            );
        }

        if (!$orders) {
            return $requestBody;
        }

        $requestBody['sort'] = array_merge_recursive($requestBody['sort'] ?? [], $orders);

        return $requestBody;
    }

    private function getOrder(string $resourceClass, string $property, string $direction): array
    {
        $order = ['order' => strtolower($direction)];

        if (null !== $nestedPath = $this->getNestedFieldPath($resourceClass, $property)) {
            $nestedPath = null === $this->nameConverter ? $nestedPath : $this->nameConverter->normalize($nestedPath, $resourceClass);
            $order['nested'] = ['path' => $nestedPath];
        }

        $property = null === $this->nameConverter ? $property : $this->nameConverter->normalize($property, $resourceClass);

        return [$property => $order];
    }
}
