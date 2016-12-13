<?php
Namespace Helpers
{
  USE ServiceProvider\ConfigServiceProvider AS Config;

  Class Bootstrap
  {
    private $args = [];

    private $map  = [
      'ec2'         => [ 'Aliases' => ['ec2', 'instance', 'node'],
          'Client'  => 'Ec2\\Ec2Client',
      ],

      'rds'         => [ 'Aliases' => ['rds', 'db', 'database' ],
          'Client'  => 'Rds\\RdsClient',
      ],

      'elasticache' => [ 'Aliases' => ['ecc', 'cache', 'cluster'],
          'Client'  => 'ElastiCache\\ElastiCacheClient',
      ],

      'redshift'      => [ 'Aliases' => ['rsf', 'red', 'shift'],
            'Client'  => 'Redshift\\RedshiftClient',
      ],
    ];


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

    private function get($string)
    {
      return (isset($this->args->$string)) ? $this->args->$string : null;
    }
  }
}