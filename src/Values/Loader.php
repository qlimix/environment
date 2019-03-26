<?php declare(strict_types=1);

namespace Qlimix\Environment;

use Qlimix\Environment\Values\Exception\LoaderException;
use function explode;
use function in_array;
use function is_numeric;
use function getenv;

final class Loader
{
    /**
     * @throws LoaderException
     */
    public function getString(string $name): string
    {
        return $this->getEnv($name);
    }

    /**
     * @throws LoaderException
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
     * @throws LoaderException
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
     * @throws LoaderException
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
     * @throws LoaderException
     */
    public function getArray(string $name, string $delimiter): array
    {
        return explode($delimiter, $this->getEnv($name));
    }

    /**
     * @return mixed
     *
     * @throws LoaderException
     */
    public function getMapped(string $name, callable $map)
    {
        return $map($this->getEnv($name));
    }

    /**
     * @throws LoaderException
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
