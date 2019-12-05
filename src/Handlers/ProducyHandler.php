<?php

namespace App\Handlers;

use Doctrine\ORM\EntityManager;

/**
 * Class ProducyHandler
 * @package App\Handlers
 */
class ProducyHandler
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}