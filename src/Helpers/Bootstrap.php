<?php
Namespace Helpers
{
  USE ServiceProvider\ConfigServiceProvider AS Config;

  Class Bootstrap
  {
    private $args = [];

    /**
     * Bootstrap constructor.
     * @param array $payload
     */
    public function __construct(array $payload = [])
    {
      if (! $payload['type'] ?: 0) parse_str(implode("&", array_slice($payload['args'], 1)), $_GET);

      $config = New Config(ENV_FILE);

      $config->register([
        'ReservedInstances' => [
          'Accounts' => []
      ]]);

      $this->setArguments($_GET,                []); //filter if reqs
      $this->setArguments($config->getConfig(), []);
    }

    public function run()
    {
      print_r($this);
    }

    /**
     * Set requirements
     *
     * @param array $args
     * @param array $reqs
     * @return $this
     */
    protected function setArguments(array $args = [], array $reqs)
    {
      if (empty($args)) Throw New \RuntimeException('Input cannot be empty, terminating...');

      foreach ($reqs AS $requirement) if (! isset($args[$requirement])) {
        Throw New \OutOfBoundsException("Arguments requires: $requirement");
      }

      $this->args = ($args + $this->args);
      return $this;
    }
  }
}