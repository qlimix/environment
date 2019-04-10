<?php declare(strict_types=1);

namespace Qlimix\Environment\Value;

use Qlimix\Environment\Value\Exception\LoaderException;
use function explode;
use function getenv;
use function in_array;
use function is_numeric;

final class Loader implements LoaderInterface
{
    /**
     * @inheritDoc
     */
    public function getString(string $name): string
    {
        return $this->getEnv($name);
    }

    /**
     * @inheritDoc
     */
    public function getInt(string $name): int
    {
        $env = $this->getEnv($name);
        if (!is_numeric($env)) {
            throw new LoaderException('non numeric value can\'t be an integer');
        }

        return (int) $env;
    }

    /**
     * @inheritDoc
     */
    public function getFloat(string $name): float
    {
        $env = $this->getEnv($name);
        if (!is_numeric($env)) {
            throw new LoaderException('non numeric value can\'t be an float');
        }

        return (float) $env;
    }

    /**
     * @inheritDoc
     */
    public function getBoolean(string $name): bool
    {
        $env = $this->getEnv($name);
        if (!in_array($env, ['1', '0', 'true', 'false'], true)) {
            throw new LoaderException('Invalid value (not 1,0,true,false) can\'t be an boolean');
        }

        if ($env === 'true') {
            $env = true;
        } elseif ($env === 'false') {
            $env = false;
        } else {
            $env = (bool) $env;
        }

        return $env;
    }

    /**
     * @inheritDoc
     */
    public function getArray(string $name, string $delimiter): array
    {
        $exploded = explode($delimiter, $this->getEnv($name));

        if ($exploded === false) {
            throw new LoaderException('Failed to get array');
        }

        return $exploded;
    }

    /**
     * @inheritDoc
     */
    public function getMapped(string $name, callable $map)
    {
        return $map($this->getEnv($name));
    }

    /**
     * @inheritDoc
     */
    private function getEnv(string $name): string
    {
        $value = getenv($name, true);
        if ($value === false) {
            throw new LoaderException('Could not find env');
        }

        return $value;
    }
}
