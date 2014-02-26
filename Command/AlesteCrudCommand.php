<?php

namespace Aleste\Bundle\CrudGeneratorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
use Aleste\Bundle\CrudGeneratorBundle\Generator\AlesteCrudGenerator;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

/**
 * Generates a CRUD for a Doctrine entity.
 *
 * @author Alejandro Steinmetz <asteinmetz78@gmail.com>
 */
class AlesteCrudCommand extends GenerateDoctrineCrudCommand
{
    private $generator;
    private $formGenerator;

    protected function configure()
    {
        parent::configure();

        $this->setName('aleste:generate:crud');
        $this->setDescription('Generates a CRUD and paginator based on a Doctrine entity');
    }

    protected function createGenerator($bundle = null)
    {
        return new AlesteCrudGenerator($this->getContainer()->get('filesystem'));
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get('kernel')->getRootdir().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }
}