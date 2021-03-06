<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of DeckCheckerPass
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class DeckCheckPass implements CompilerPassInterface
{
    public function process (ContainerBuilder $container)
    {
        if ($container->has('app.deck_validator') === false) {
            return;
        }

        $definition = $container->findDefinition('app.deck_validator');

        $taggedServices = $container->findTaggedServiceIds('app.deck_check');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addDeckCheck', [new Reference($id)]);
        }
    }
}
