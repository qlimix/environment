<?php declare(strict_types=1);

final class Environment
{
    private const PRODUCTION = 'prod';
    private const DEVELOPMENT = 'dev';

    /** @var string */
    private $env;

    /**
     * @param string $env
     */
    public function __construct(string $env)
    {
        $this->env = $env;
    }

    /**
     * @return Environment
     */
    public static function createDevelopment(): Environment
    {
        return new self(self::DEVELOPMENT);
    }

    /**
     * @return Environment
     */
    public static function createProduction(): Environment
    {
        return new self(self::PRODUCTION);
    }

    /**
     * @param Environment $environment
     *
     * @return bool
     */
    public function equals(Environment $environment): bool
    {
        return $environment->getEnv() === $this->env;
    }

    /**
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }
}
