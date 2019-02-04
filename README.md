Depency Injection (Symfony 4.2)
======

An overview of the main features of the [symfony/dependency-injection](https://github.com/symfony/dependency-injection) package. 

Tags allow to navigate between the different parts.

Default Application
-----

Tag: `start`

The default application without depency injection container.

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

[To be continued...]
