Depency Injection (Symfony 4.2)
======

An overview of the main features of the [symfony/dependency-injection](https://github.com/symfony/dependency-injection) package. 

Usage
-----

Clone the repository:
```
$ git clone https://github.com/jlttt/sdic.git
```
Install dependencies:
```
$ cd sdic 
$ composer install
```

Run the application:
```
$ ./bin/deploy
```

Tags allow to navigate between the different parts. For example, to go to the code of the default application, use:
```
$ git checkout start
```

Default Application
-----

Tag: `start`

The default application without depency injection container.
To automate deployment of customer clouds, one ask a `CloudProvider` service the list of existing clouds (throw an API), select one of them and deploy it thanks to the Jenkins API.

![UML diagram of the application](http://yuml.me/0678f50b.png)

Depency Injection Container
----

Tag: `dependency-injection-container`

Basic use of the dependency injection container.

Useful objects and methods:
- `Definition`: Definition of a service, creation for a FQCN
- `Reference`: Reference to a service, creation from a service id.
- `ContainerBuilder::setDefintion(serviceId, definition)` : register a definition
- `ContainerBuilder::register(serviceId, fqcn)`: register a class as definition
- `Definition::setArgument(reference)`: register a dependency (as a service reference) to a definition

Autowiring
----

Tag: `autowiring`

Automatic depency injection.
Argument setting is no more needed, but container needs to be compiled.

Useful methods:
- `Definition::setAutowired`: active/unactive autowiring for the service
- `ContainerBuilder::compile`: Compilation of the container

Autoconfiguration
----

Tag: `autoconfiguration`

Exploration of the application to find services (thanks to PSR-4).
Require the [symfony/config](https://github.com/symfony/config) package and the container needs to be compiled.

Useful objects and methods:
- `FileLoader`,
- `FileLoader::registerClasses(baseDefinition, namespace, path)`: register services of a namespace from a base definition
- `Definition::setAutoconfigured`: active/unactive autoconfiguration

Configuration file
-----

Tag: `config-file`

Use the config component to move container configuration in a specific file.

Useful methods:
- `FileLoader::load(configFile)` : a context with preset variables (`$container`, `$loader`,...) is provided to the configuration file

Improve application: add filters
-----

Tag: `filter-feature`

To go deeper, one needs to extend the initial application by allowing to filter clouds.

![UML diagram of the extended application](http://yuml.me/f19b03a6.png)

Scalar values injection
-----

Tag: `scalar-values-injection`

Container injects classes. It can also inject scalar values (string, array, int,...).

Useful methods:
- `ContainerBuilder::setParameter(id, scalarValue)`: register a scalar value
- `ContainerBuilder::addArgument('%id%')`: use a registered scalar value (note that the id is surrounded by `%`)

Method call
-----

Tag: `add-method-call`

A service definition can be enhanced by registring method calls to play right after the service instanciation.

Useful methods:
- `Definition::addMethodCall(method, arguments)`

Tags and compiler pass
-----

Tag: `tags-and-compiler-pass`

A service definition can be enhanced by registering method calls to play right after the service instanciation.

Useful class and methods:
- `CompilerPassInterface` : contract for a new compiler pass
- `ContainerBuilder::addCompilerPass(compilerPass)`: register the given compiler pass to be run at compilation time
- `ContainerBuilder::registerForAutoconfiguration(fqcn)`: prepare the autoconfiguration to extract all classes extending fqcn
- `ContainerBuilder::findTaggedServiceIds(tag)`: retrieve services by tag
- `Definition::addTag(tag)`: tag a service

YAML Configuration file
-----

Tag: `yaml-config-file`

Use Yaml format for configuration file.
Require the [symfony/yaml](https://github.com/symfony/yaml) package

Useful objects:
- `YamlFileLoader`

Dump container
-----

Tag: `container-dump`

The container can be cached to avoid compilation at each application run.

Useful objects and methods:
- `PhpDumper::dump(options)` : dump as PHP class

