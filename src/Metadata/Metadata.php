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

use ApiPlatform\State\OptionsInterface;

/**
 * @psalm-inheritors ApiResource|Operation
 */
abstract class Metadata
{
    protected ?Parameters $parameters = null;

    /**
     * @param class-string                                                                      $class
     * @param string|null                                                                       $deprecationReason       https://api-platform.com/docs/core/deprecations/#deprecating-resource-classes-operations-and-properties
     * @param string|\Stringable|null                                                           $security                https://api-platform.com/docs/core/security
     * @param string|\Stringable|null                                                           $securityPostDenormalize https://api-platform.com/docs/core/security/#executing-access-control-rules-after-denormalization
     * @param mixed|null                                                                        $mercure
     * @param mixed|null                                                                        $messenger
     * @param mixed|null                                                                        $input
     * @param mixed|null                                                                        $output
     * @param mixed|null                                                                        $provider
     * @param mixed|null                                                                        $processor
     * @param Parameters|array<string, Parameter>                                               $parameters
     * @param callable|string|array<string, \Illuminate\Contracts\Validation\Rule|array|string> $rules                   Laravel rules can be a FormRequest class, a callable or an array of rules
     */
    public function __construct(
        protected ?string $shortName = null,
        protected ?string $class = null,
        protected ?string $description = null,
        protected ?int $urlGenerationStrategy = null,
        protected ?string $deprecationReason = null,
        protected ?array $normalizationContext = null,
        protected ?array $denormalizationContext = null,
        protected ?bool $collectDenormalizationErrors = null,
        protected ?array $validationContext = null,
        protected ?array $filters = null,
        protected $mercure = null,
        protected $messenger = null,
        protected $input = null,
        protected $output = null,
        protected ?array $order = null,
        protected ?bool $fetchPartial = null,
        protected ?bool $forceEager = null,
        protected ?bool $paginationEnabled = null,
        protected ?string $paginationType = null,
        protected ?int $paginationItemsPerPage = null,
        protected ?int $paginationMaximumItemsPerPage = null,
        protected ?bool $paginationPartial = null,
        protected ?bool $paginationClientEnabled = null,
        protected ?bool $paginationClientItemsPerPage = null,
        protected ?bool $paginationClientPartial = null,
        protected ?bool $paginationFetchJoinCollection = null,
        protected ?bool $paginationUseOutputWalkers = null,
        protected string|\Stringable|null $security = null,
        protected ?string $securityMessage = null,
        protected string|\Stringable|null $securityPostDenormalize = null,
        protected ?string $securityPostDenormalizeMessage = null,
        protected string|\Stringable|null $securityPostValidation = null,
        protected ?string $securityPostValidationMessage = null,
        protected $provider = null,
        protected $processor = null,
        protected ?OptionsInterface $stateOptions = null,
        /*
         * @experimental
         */
        array|Parameters|null $parameters = null,
        protected mixed $rules = null,
        protected ?string $policy = null,
        protected array|string|null $middleware = null,
        protected ?bool $queryParameterValidationEnabled = null,
        protected ?bool $strictQueryParameterValidation = null,
        protected ?bool $hideHydraOperation = null,
        protected array $extraProperties = [],
    ) {
        if (\is_array($parameters) && $parameters) {
            $parameters = new Parameters($parameters);
        }

        $this->parameters = $parameters;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function withShortName(string $shortName): static
    {
        $self = clone $this;
        $self->shortName = $shortName;

        return $self;
    }

    /**
     * @return class-string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param class-string $class
     */
    public function withClass(string $class): static
    {
        $self = clone $this;
        $self->class = $class;

        return $self;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function withDescription(?string $description = null): static
    {
        $self = clone $this;
        $self->description = $description;

        return $self;
    }

    public function getUrlGenerationStrategy(): ?int
    {
        return $this->urlGenerationStrategy;
    }

    public function withUrlGenerationStrategy(int $urlGenerationStrategy): static
    {
        $self = clone $this;
        $self->urlGenerationStrategy = $urlGenerationStrategy;

        return $self;
    }

    public function getDeprecationReason(): ?string
    {
        return $this->deprecationReason;
    }

    public function withDeprecationReason($deprecationReason): static
    {
        $self = clone $this;
        $self->deprecationReason = $deprecationReason;

        return $self;
    }

    public function getNormalizationContext(): ?array
    {
        return $this->normalizationContext;
    }

    public function withNormalizationContext(array $normalizationContext): static
    {
        $self = clone $this;
        $self->normalizationContext = $normalizationContext;

        return $self;
    }

    public function getDenormalizationContext(): ?array
    {
        return $this->denormalizationContext;
    }

    public function withDenormalizationContext(array $denormalizationContext): static
    {
        $self = clone $this;
        $self->denormalizationContext = $denormalizationContext;

        return $self;
    }

    public function getCollectDenormalizationErrors(): ?bool
    {
        return $this->collectDenormalizationErrors;
    }

    public function withCollectDenormalizationErrors(?bool $collectDenormalizationErrors = null): static
    {
        $self = clone $this;
        $self->collectDenormalizationErrors = $collectDenormalizationErrors;

        return $self;
    }

    public function getValidationContext(): ?array
    {
        return $this->validationContext;
    }

    public function withValidationContext(array $validationContext): static
    {
        $self = clone $this;
        $self->validationContext = $validationContext;

        return $self;
    }

    /**
     * @return string[]|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    public function withFilters(array $filters): static
    {
        $self = clone $this;
        $self->filters = $filters;

        return $self;
    }

    public function getMercure(): mixed
    {
        return $this->mercure;
    }

    public function withMercure(mixed $mercure): static
    {
        $self = clone $this;
        $self->mercure = $mercure;

        return $self;
    }

    public function getMessenger(): mixed
    {
        return $this->messenger;
    }

    public function withMessenger(mixed $messenger): static
    {
        $self = clone $this;
        $self->messenger = $messenger;

        return $self;
    }

    public function getInput(): mixed
    {
        return $this->input;
    }

    public function withInput(mixed $input): static
    {
        $self = clone $this;
        $self->input = $input;

        return $self;
    }

    public function getOutput(): mixed
    {
        return $this->output;
    }

    public function withOutput(mixed $output): static
    {
        $self = clone $this;
        $self->output = $output;

        return $self;
    }

    public function getOrder(): ?array
    {
        return $this->order;
    }

    public function withOrder(array $order): static
    {
        $self = clone $this;
        $self->order = $order;

        return $self;
    }

    public function getFetchPartial(): ?bool
    {
        return $this->fetchPartial;
    }

    public function withFetchPartial(bool $fetchPartial): static
    {
        $self = clone $this;
        $self->fetchPartial = $fetchPartial;

        return $self;
    }

    public function getForceEager(): ?bool
    {
        return $this->forceEager;
    }

    public function withForceEager(bool $forceEager): static
    {
        $self = clone $this;
        $self->forceEager = $forceEager;

        return $self;
    }

    public function getPaginationEnabled(): ?bool
    {
        return $this->paginationEnabled;
    }

    public function withPaginationEnabled(bool $paginationEnabled): static
    {
        $self = clone $this;
        $self->paginationEnabled = $paginationEnabled;

        return $self;
    }

    public function getPaginationType(): ?string
    {
        return $this->paginationType;
    }

    public function withPaginationType(string $paginationType): static
    {
        $self = clone $this;
        $self->paginationType = $paginationType;

        return $self;
    }

    public function getPaginationItemsPerPage(): ?int
    {
        return $this->paginationItemsPerPage;
    }

    public function withPaginationItemsPerPage(int $paginationItemsPerPage): static
    {
        $self = clone $this;
        $self->paginationItemsPerPage = $paginationItemsPerPage;

        return $self;
    }

    public function getPaginationMaximumItemsPerPage(): ?int
    {
        return $this->paginationMaximumItemsPerPage;
    }

    public function withPaginationMaximumItemsPerPage(int $paginationMaximumItemsPerPage): static
    {
        $self = clone $this;
        $self->paginationMaximumItemsPerPage = $paginationMaximumItemsPerPage;

        return $self;
    }

    public function getPaginationPartial(): ?bool
    {
        return $this->paginationPartial;
    }

    public function withPaginationPartial(bool $paginationPartial): static
    {
        $self = clone $this;
        $self->paginationPartial = $paginationPartial;

        return $self;
    }

    public function getPaginationClientEnabled(): ?bool
    {
        return $this->paginationClientEnabled;
    }

    public function withPaginationClientEnabled(bool $paginationClientEnabled): static
    {
        $self = clone $this;
        $self->paginationClientEnabled = $paginationClientEnabled;

        return $self;
    }

    public function getPaginationClientItemsPerPage(): ?bool
    {
        return $this->paginationClientItemsPerPage;
    }

    public function withPaginationClientItemsPerPage(bool $paginationClientItemsPerPage): static
    {
        $self = clone $this;
        $self->paginationClientItemsPerPage = $paginationClientItemsPerPage;

        return $self;
    }

    public function getPaginationClientPartial(): ?bool
    {
        return $this->paginationClientPartial;
    }

    public function withPaginationClientPartial(bool $paginationClientPartial): static
    {
        $self = clone $this;
        $self->paginationClientPartial = $paginationClientPartial;

        return $self;
    }

    public function getPaginationFetchJoinCollection(): ?bool
    {
        return $this->paginationFetchJoinCollection;
    }

    public function withPaginationFetchJoinCollection(bool $paginationFetchJoinCollection): static
    {
        $self = clone $this;
        $self->paginationFetchJoinCollection = $paginationFetchJoinCollection;

        return $self;
    }

    public function getPaginationUseOutputWalkers(): ?bool
    {
        return $this->paginationUseOutputWalkers;
    }

    public function withPaginationUseOutputWalkers(bool $paginationUseOutputWalkers): static
    {
        $self = clone $this;
        $self->paginationUseOutputWalkers = $paginationUseOutputWalkers;

        return $self;
    }

    public function getSecurity(): ?string
    {
        return $this->security instanceof \Stringable ? (string) $this->security : $this->security;
    }

    public function withSecurity($security): static
    {
        $self = clone $this;
        $self->security = $security;

        return $self;
    }

    public function getSecurityMessage(): ?string
    {
        return $this->securityMessage;
    }

    public function withSecurityMessage(string $securityMessage): static
    {
        $self = clone $this;
        $self->securityMessage = $securityMessage;

        return $self;
    }

    public function getSecurityPostDenormalize(): ?string
    {
        return $this->securityPostDenormalize instanceof \Stringable ? (string) $this->securityPostDenormalize : $this->securityPostDenormalize;
    }

    public function withSecurityPostDenormalize($securityPostDenormalize): static
    {
        $self = clone $this;
        $self->securityPostDenormalize = $securityPostDenormalize;

        return $self;
    }

    public function getSecurityPostDenormalizeMessage(): ?string
    {
        return $this->securityPostDenormalizeMessage;
    }

    public function withSecurityPostDenormalizeMessage(string $securityPostDenormalizeMessage): static
    {
        $self = clone $this;
        $self->securityPostDenormalizeMessage = $securityPostDenormalizeMessage;

        return $self;
    }

    public function getSecurityPostValidation(): ?string
    {
        return $this->securityPostValidation instanceof \Stringable ? (string) $this->securityPostValidation : $this->securityPostValidation;
    }

    public function withSecurityPostValidation(string|\Stringable|null $securityPostValidation = null): static
    {
        $self = clone $this;
        $self->securityPostValidation = $securityPostValidation;

        return $self;
    }

    public function getSecurityPostValidationMessage(): ?string
    {
        return $this->securityPostValidationMessage;
    }

    public function withSecurityPostValidationMessage(?string $securityPostValidationMessage = null): static
    {
        $self = clone $this;
        $self->securityPostValidationMessage = $securityPostValidationMessage;

        return $self;
    }

    public function getProcessor(): callable|string|null
    {
        return $this->processor;
    }

    public function withProcessor(callable|string|null $processor): static
    {
        $self = clone $this;
        $self->processor = $processor;

        return $self;
    }

    public function getProvider(): callable|string|null
    {
        return $this->provider;
    }

    public function withProvider(callable|string|null $provider): static
    {
        $self = clone $this;
        $self->provider = $provider;

        return $self;
    }

    public function getStateOptions(): ?OptionsInterface
    {
        return $this->stateOptions;
    }

    public function withStateOptions(?OptionsInterface $stateOptions): static
    {
        $self = clone $this;
        $self->stateOptions = $stateOptions;

        return $self;
    }

    /**
     * @return string|callable|array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function getRules(): mixed
    {
        return $this->rules;
    }

    /**
     * @param string|callable|array<string, \Illuminate\Contracts\Validation\Rule|array|string> $rules
     */
    public function withRules(mixed $rules): static
    {
        $self = clone $this;
        $self->rules = $rules;

        return $self;
    }

    public function getParameters(): ?Parameters
    {
        return $this->parameters;
    }

    public function withParameters(array|Parameters $parameters): static
    {
        $self = clone $this;
        $self->parameters = \is_array($parameters) ? new Parameters($parameters) : $parameters;

        return $self;
    }

    public function getQueryParameterValidationEnabled(): ?bool
    {
        return $this->queryParameterValidationEnabled;
    }

    public function withQueryParameterValidationEnabled(bool $queryParameterValidationEnabled): static
    {
        $self = clone $this;
        $self->queryParameterValidationEnabled = $queryParameterValidationEnabled;

        return $self;
    }

    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    public function withPolicy(string $policy): static
    {
        $self = clone $this;
        $self->policy = $policy;

        return $self;
    }

    public function getMiddleware(): mixed
    {
        return $this->middleware;
    }

    public function withMiddleware(string|array $middleware): static
    {
        $self = clone $this;
        $self->middleware = $middleware;

        return $self;
    }

    public function getExtraProperties(): ?array
    {
        return $this->extraProperties;
    }

    public function withExtraProperties(array $extraProperties = []): static
    {
        $self = clone $this;
        $self->extraProperties = $extraProperties;

        return $self;
    }

    public function getStrictQueryParameterValidation(): ?bool
    {
        return $this->strictQueryParameterValidation;
    }

    public function withStrictQueryParameterValidation(bool $strictQueryParameterValidation): static
    {
        $self = clone $this;
        $self->strictQueryParameterValidation = $strictQueryParameterValidation;

        return $self;
    }

    public function getHideHydraOperation(): ?bool
    {
        return $this->hideHydraOperation;
    }

    public function withHideHydraOperation(bool $hideHydraOperation): static
    {
        $self = clone $this;
        $self->hideHydraOperation = $hideHydraOperation;

        return $self;
    }
}
