<?php declare(strict_types=1);

namespace Qlimix\Environment;

final class Environment
{
    private const PRODUCTION = 'prod';
    private const DEVELOPMENT = 'dev';

    private string $env;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    public static function createDevelopment(): Environment
    {
        return new self(self::DEVELOPMENT);
    }

    public static function createProduction(): Environment
    {
        return new self(self::PRODUCTION);
    }

    public function equals(Environment $environment): bool
    {
        return $environment->getEnv() === $this->env;
    }

    public function getEnv(): string
    {
        return $this->env;
    }
}
