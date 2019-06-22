<?php

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class ProdutoResolver
 *
 * @package App\GraphQL\Resolver
 */
class ProdutoResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * ProdutoResolver constructor.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => 'Produto'
        ];
    }

    /**
     * Executa as querys
     *
     * @param \Overblog\GraphQLBundle\Definition\Argument $argument
     * @return object|null
     */
    public function resolve(Argument $argument)
    {
        $produto = $this->entityManager->getRepository("App:Produto")->find($argument['id']);

        return $produto;
    }
}