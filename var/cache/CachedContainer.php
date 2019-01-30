<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class CachedContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = array();
        $this->methodMap = array(
            'Ubi\\Deploy\\Deploy' => 'getDeployService',
        );

        $this->aliases = array();
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function getRemovedIds()
    {
        return array(
            '.abstract.instanceof.Ubi\\Deploy\\Service\\SlugFilter' => true,
            '.abstract.instanceof.Ubi\\Deploy\\Service\\VersionFilter' => true,
            '.instanceof.Ubi\\Deploy\\Service\\Filter.0.Ubi\\Deploy\\Service\\SlugFilter' => true,
            '.instanceof.Ubi\\Deploy\\Service\\Filter.0.Ubi\\Deploy\\Service\\VersionFilter' => true,
            'Http\\Client\\HttpClient' => true,
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'Ubi\\Deploy\\DependencyInjection\\FilterPass' => true,
            'Ubi\\Deploy\\Entity\\Cloud' => true,
            'Ubi\\Deploy\\Service\\CloudProvider' => true,
            'Ubi\\Deploy\\Service\\JenkinsManager' => true,
            'Ubi\\Deploy\\Service\\SlugFilter' => true,
            'Ubi\\Deploy\\Service\\VersionFilter' => true,
        );
    }

    /**
     * Gets the public 'Ubi\Deploy\Deploy' shared autowired service.
     *
     * @return \Ubi\Deploy\Deploy
     */
    protected function getDeployService()
    {
        $a = new \Http\Adapter\Guzzle6\Client();

        $this->services['Ubi\Deploy\Deploy'] = $instance = new \Ubi\Deploy\Deploy(new \Ubi\Deploy\Service\CloudProvider($a), new \Ubi\Deploy\Service\JenkinsManager($a));

        $instance->addFilter(new \Ubi\Deploy\Service\SlugFilter($this->parameters['allowed_slugs']));
        $instance->addFilter(new \Ubi\Deploy\Service\VersionFilter($this->parameters['allowed_versions']));

        return $instance;
    }

    public function getParameter($name)
    {
        $name = (string) $name;

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        $name = (string) $name;

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array();
    private $dynamicParameters = array();

    /**
     * Computes a dynamic parameter.
     *
     * @param string $name The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'allowed_slugs' => array(
                0 => 'dev',
                1 => 'preprod',
            ),
            'allowed_versions' => array(
                0 => '2.62',
                1 => '2.61',
            ),
        );
    }
}
