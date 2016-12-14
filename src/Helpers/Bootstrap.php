<?php
Namespace Helpers
{
  USE ServiceProvider\ConfigServiceProvider AS Config;
  USE ServiceMapper\AwsServiceMapper        AS Mapper;

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

      $this->setArguments($_GET,                ['DryRun']  ); //filter if reqs
      $this->setArguments($config->getConfig(), ['Accounts']);
    }

    public function run()
    {
      $map = New Mapper('services.json'); //should be abstracted into a variable somewhere...

      if (isset($this->args ['Accounts']) && ! empty($this->args ['Use']))
      {
        foreach ($this->args ['Accounts'] AS $name => $number)
        {
          foreach ($this->args ['Use'] [$name] AS $service)
          {


            echo "{$number}: " . ucfirst($service) . "Client\n";
          }
        }
      }
    }

    /**
     * Set requirements
     *
     * @param array $args
     * @param array $reqs     * @return $this
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

    private function get($string)
    {
      return (isset($this->args->$string)) ? $this->args->$string : null;
    }
  }
}