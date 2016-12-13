<?php
/**
 * Move to Interface
 */
Namespace ServiceProvider
{
  Interface ConfigDriver
  {
    /**
     * @param $filename
     * @return mixed
     */
    function load($filename);

    /**
     * @param $filename
     * @return mixed
     */
    function supports($filename);
  }
}