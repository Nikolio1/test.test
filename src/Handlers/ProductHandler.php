<?php

namespace App\Handlers;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProductHandler
 * @package App\Handlers
 */
class ProductHandler
{
    protected $em;

    /**
     * ProductHandler constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}