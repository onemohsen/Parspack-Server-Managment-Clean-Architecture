<?php

declare(strict_types=1);

namespace Domain\Parspack\Services;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use phpseclib3\Net\SSH2;

class SshService implements SshInterface
{
    private array $config;
    private string $host;
    private string $username;
    private string $password;
    private $ssh;
    private $isLogin = false;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->host = $config['host'] ?? '';
        $this->username = $config['username'] ?? '';
        $this->password = $config['password'] ?? '';
        $this->ssh = new SSH2($this->host);
    }


    public function login(string $username = null, string $password = null): bool
    {
        if (!$this->ssh->login($username ?? $this->username, $password ?? $this->password)) {
            $this->isLogin = false;
            throw new \Exception('Login failed');
        }

        $this->isLogin = true;
        return true;
    }

    public function exec(string $command): string
    {
        if (!$this->isLogin) {
            $this->login();
        }
        $return_value = $this->ssh->exec($command);
        return $return_value;
    }
}
