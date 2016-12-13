<?php
Namespace ServiceProvider
{
  Class ChainConfigDriver Implements ConfigDriver
  {
    private $drivers;

    /**
     * ChainConfigDriver constructor.
     * @param array $drivers
     */
    public function __construct(array $drivers)
    {
      $this->drivers = $drivers;
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function load($filename)
    {
      $driver = $this->getDriver($filename);

      return $driver->load($filename);
    }

    /**
     * @param $filename
     * @return bool
     */
    public function supports($filename)
    {
      return (bool) $this->getDriver($filename);
    }


    /**
     * @param $filename
     * @return mixed|null
     */
    private function getDriver($filename)
    {
      foreach ($this->drivers AS $driver)
      {
        if ($driver->supports($filename)) return $driver;
      }

      return null;
    }
  }
}