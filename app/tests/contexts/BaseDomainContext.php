<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Behat context class.
 */
 class BaseDomainContext implements SnippetAcceptingContext
{
    use BootstrapLaravel;
}
