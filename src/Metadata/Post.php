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

namespace ApiPlatform\Metadata;

use ApiPlatform\OpenApi\Attributes\Webhook;
use ApiPlatform\OpenApi\Model\Operation as OpenApiOperation;
use ApiPlatform\State\OptionsInterface;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class Post extends HttpOperation
{
    public function __construct(
        ?string $uriTemplate = null,
        ?array $types = null,
        $formats = null,
        $inputFormats = null,
        $outputFormats = null,
        $uriVariables = null,
        ?string $routePrefix = null,
        ?string $routeName = null,
        ?array $defaults = null,
        ?array $requirements = null,
        ?array $options = null,
        ?bool $stateless = null,
        ?string $sunset = null,
        ?string $acceptPatch = null,
        $status = null,
        ?string $host = null,
        ?array $schemes = null,
        ?string $condition = null,
        ?string $controller = null,
        ?array $headers = null,
        ?array $cacheHeaders = null,
        ?array $paginationViaCursor = null,
        ?array $hydraContext = null,
        bool|OpenApiOperation|Webhook|null $openapi = null,
        ?array $exceptionToStatus = null,
        ?bool $queryParameterValidationEnabled = null,
        ?array $links = null,
        ?array $errors = null,

        ?string $shortName = null,
        ?string $class = null,
        ?bool $paginationEnabled = null,
        ?string $paginationType = null,
        ?int $paginationItemsPerPage = null,
        ?int $paginationMaximumItemsPerPage = null,
        ?bool $paginationPartial = null,
        ?bool $paginationClientEnabled = null,
        ?bool $paginationClientItemsPerPage = null,
        ?bool $paginationClientPartial = null,
        ?bool $paginationFetchJoinCollection = null,
        ?bool $paginationUseOutputWalkers = null,
        ?array $order = null,
        ?string $description = null,
        ?array $normalizationContext = null,
        ?array $denormalizationContext = null,
        ?bool $collectDenormalizationErrors = null,
        string|\Stringable|null $security = null,
        ?string $securityMessage = null,
        string|\Stringable|null $securityPostDenormalize = null,
        ?string $securityPostDenormalizeMessage = null,
        string|\Stringable|null $securityPostValidation = null,
        ?string $securityPostValidationMessage = null,
        ?string $deprecationReason = null,
        ?array $filters = null,
        ?array $validationContext = null,
        $input = null,
        $output = null,
        $mercure = null,
        $messenger = null,
        ?int $urlGenerationStrategy = null,
        ?bool $read = null,
        ?bool $deserialize = null,
        ?bool $validate = null,
        ?bool $write = null,
        ?bool $serialize = null,
        ?bool $fetchPartial = null,
        ?bool $forceEager = null,
        ?int $priority = null,
        ?string $name = null,
        $provider = null,
        $processor = null,
        ?OptionsInterface $stateOptions = null,
        array|Parameters|null $parameters = null,
        mixed $rules = null,
        ?string $policy = null,
        array|string|null $middleware = null,
        array $extraProperties = [],
        private ?string $itemUriTemplate = null,
        ?bool $strictQueryParameterValidation = null,
        ?bool $hideHydraOperation = null,
    ) {
        parent::__construct(
            method: 'POST',
            uriTemplate: $uriTemplate,
            types: $types,
            formats: $formats,
            inputFormats: $inputFormats,
            outputFormats: $outputFormats,
            uriVariables: $uriVariables,
            routePrefix: $routePrefix,
            routeName: $routeName,
            defaults: $defaults,
            requirements: $requirements,
            options: $options,
            stateless: $stateless,
            sunset: $sunset,
            acceptPatch: $acceptPatch,
            status: $status,
            host: $host,
            schemes: $schemes,
            condition: $condition,
            controller: $controller,
            headers: $headers,
            cacheHeaders: $cacheHeaders,
            paginationViaCursor: $paginationViaCursor,
            hydraContext: $hydraContext,
            openapi: $openapi,
            exceptionToStatus: $exceptionToStatus,
            queryParameterValidationEnabled: $queryParameterValidationEnabled,
            links: $links,
            errors: $errors,
            shortName: $shortName,
            class: $class,
            paginationEnabled: $paginationEnabled,
            paginationType: $paginationType,
            paginationItemsPerPage: $paginationItemsPerPage,
            paginationMaximumItemsPerPage: $paginationMaximumItemsPerPage,
            paginationPartial: $paginationPartial,
            paginationClientEnabled: $paginationClientEnabled,
            paginationClientItemsPerPage: $paginationClientItemsPerPage,
            paginationClientPartial: $paginationClientPartial,
            paginationFetchJoinCollection: $paginationFetchJoinCollection,
            paginationUseOutputWalkers: $paginationUseOutputWalkers,
            order: $order,
            description: $description,
            normalizationContext: $normalizationContext,
            denormalizationContext: $denormalizationContext,
            collectDenormalizationErrors: $collectDenormalizationErrors,
            security: $security,
            securityMessage: $securityMessage,
            securityPostDenormalize: $securityPostDenormalize,
            securityPostDenormalizeMessage: $securityPostDenormalizeMessage,
            securityPostValidation: $securityPostValidation,
            securityPostValidationMessage: $securityPostValidationMessage,
            deprecationReason: $deprecationReason,
            filters: $filters,
            validationContext: $validationContext,
            input: $input,
            output: $output,
            mercure: $mercure,
            messenger: $messenger,
            urlGenerationStrategy: $urlGenerationStrategy,
            read: $read,
            deserialize: $deserialize,
            validate: $validate,
            write: $write,
            serialize: $serialize,
            fetchPartial: $fetchPartial,
            forceEager: $forceEager,
            priority: $priority,
            name: $name,
            provider: $provider,
            processor: $processor,
            stateOptions: $stateOptions,
            parameters: $parameters,
            rules: $rules,
            policy: $policy,
            middleware: $middleware,
            strictQueryParameterValidation: $strictQueryParameterValidation,
            hideHydraOperation: $hideHydraOperation,
            extraProperties: $extraProperties
        );
    }

    public function getItemUriTemplate(): ?string
    {
        return $this->itemUriTemplate;
    }

    public function withItemUriTemplate(string $itemUriTemplate): self
    {
        $self = clone $this;
        $self->itemUriTemplate = $itemUriTemplate;

        return $self;
    }
}
