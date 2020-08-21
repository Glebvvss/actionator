<?php 

/**
 * Format contract
 * 
 * Result presentation of your own actions can be prepared for requirements for your needs
 */
namespace Actionator\Format;

/**
 * Interface FormatInterface
 *
 * Format interface for prepare results of actions
 * @package Actionator\Format
 */
interface FormatInterface
{
    /**
     * Method for get prepared results of action
     * 
     * @return mixed prepared by format class handler result of action
     */
    public function formattedResult();
}