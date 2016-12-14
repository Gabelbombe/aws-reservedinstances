<?php
Namespace Amazon
{
  USE Aws\Ec2\Ec2Client AS Ec2Client;

  Class Ec2 Extends Ec2Client
  {
    protected $credentials = [];

    public function __construct() {
      $this->client = New Ec2Client([

      ]);
    }
//  public describeReservedInstances ( array $args = array() )
//
//  Executes the DescribeReservedInstances operation.
//  public describeReservedInstancesListings ( array $args = array() )
//
//  Executes the DescribeReservedInstancesListings operation.
//  public describeReservedInstancesModifications ( array $args = array() )
//
//  Executes the DescribeReservedInstancesModifications operation.
//  public describeReservedInstancesOfferings ( array $args = array() )
//
//  Executes the DescribeReservedInstancesOfferings operation.

  }
}