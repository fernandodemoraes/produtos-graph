<?php

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class ProdutoListaResolver
 *
 * @package App\GraphQL\Resolver
 */
class ProdutoListaResolver implements ResolverInterface, AliasedInterface
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
            'resolve' => 'ProdutoLista',
        ];
    }

    /**
     * Executa as querys
     *
     * @param \Overblog\GraphQLBundle\Definition\Argument $argument
     * @return array
     */
    public function resolve(Argument $argument)
    {
        $produtos = $this->entityManager->getRepository("App:Produto")
            ->findBy(
                ['preco' => $argument['preco']],
                [], $argument['limit'], 0);

        return [
            'produtos' => $produtos,
        ];
    }
}