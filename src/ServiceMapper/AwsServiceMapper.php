<?php
Namespace ServiceMapper
{
  USE ServiceProvider\ConfigServiceProvider AS Config;

  Class AwsServiceMapper
  {
    protected $confDir = '';

    public function __construct($filename)
    {
      $this->confDir = dirname(dirname(__DIR__)) . '/config/';


      //      if (! file_exists()) Throw New \Exception('Required config');

      $this->setSeviceFile($filename);

      die;

    }

    private function setSeviceFile($filename)
    {
      if (file_exists($this->confDir . $filename)) {
        $config = New Config($this->confDir . $filename);

        print_r($config); exit;
      }
    }
  }
}