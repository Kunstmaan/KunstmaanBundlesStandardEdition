<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new Kunstmaan\UtilitiesBundle\KunstmaanUtilitiesBundle(),
            new Kunstmaan\NodeBundle\KunstmaanNodeBundle(),
            new Kunstmaan\SeoBundle\KunstmaanSeoBundle(),
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Kunstmaan\MediaBundle\KunstmaanMediaBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Kunstmaan\AdminBundle\KunstmaanAdminBundle(),
            new Kunstmaan\PagePartBundle\KunstmaanPagePartBundle(),
            new Kunstmaan\MediaPagePartBundle\KunstmaanMediaPagePartBundle(),
            new Kunstmaan\FormBundle\KunstmaanFormBundle(),
            new Kunstmaan\AdminListBundle\KunstmaanAdminListBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Kunstmaan\SearchBundle\KunstmaanSearchBundle(),
            new Kunstmaan\NodeSearchBundle\KunstmaanNodeSearchBundle(),
            new Kunstmaan\GeneratorBundle\KunstmaanGeneratorBundle(),
            new Kunstmaan\NewRelicBundle\KunstmaanNewRelicBundle(),
            new Kunstmaan\BehatBundle\KunstmaanBehatBundle(),
            new Kunstmaan\SitemapBundle\KunstmaanSitemapBundle(),
            new Kunstmaan\ArticleBundle\KunstmaanArticleBundle(),
            new Liip\CacheControlBundle\LiipCacheControlBundle(),
            new Kunstmaan\TranslatorBundle\KunstmaanTranslatorBundle()
        );

        if (in_array($this->getEnvironment(), array('prod'))){
            $bundles[] = new Kunstmaan\SentryBundle\KunstmaanSentryBundle();
        }

        if (in_array($this->getEnvironment(), array('dev'))){
            $bundles[] = new Kunstmaan\LiveReloadBundle\KunstmaanLiveReloadBundle();
        }

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
