# Documentation knight-artifact-entity-adapter-ksql

Knight PHP library for build query in SQL; the default dialect implement is MySQL.

**NOTE:** This repository is part of [Knight](https://github.com/energia-source/knight). Any
support requests, bug reports, or development contributions should be directed to
that project.

## Structure

library:
    - [KSQL\adapters\map\common](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/adapters/map/common)
    - [KSQL\adapters\map](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/adapters/map)
    - [KSQL\adapters](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/adapters)
    - [KSQL\connection\drivers](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/connection/drivers)
    - [KSQL\connection](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/connection)
    - [KSQL\dialects\constraint](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/dialects/constraint)
    - [KSQL\dialects](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/dialects)
    - [KSQL\entity](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/entity)
    - [KSQL\operations\common\features\parser](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/common/features/parser)
    - [KSQL\operations\common\features](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/common/features)
    - [KSQL\operations\common](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/common)
    - [KSQL\operations\select\group](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/select/group)
    - [KSQL\operations\select\order\base](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/select/order/base)
    - [KSQL\operations\select\order](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/select/order)
    - [KSQL\operations\select](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations/select)
    - [KSQL\operations](https://github.com/energia-source/knight-artifact-entity-adapter-ksql/tree/main/lib/operations)
    - [KSQL](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib)

###### ***Class KSQL\connection\Common usable methods***

This has to be an abstract class that you must extend in the drivers that you want to create.

##### `public static function dialect(string $dialect) : Dialect`

If the class exists, return an instance of it. Otherwise, throw an exception

 * **Parameters:** `string` — The name of the dialect class.

 * **Returns:** `An` — instance of the class that was passed in.

##### `public function __construct(Dialect $dialect, string ...$array)`

The constructor takes a dialect and an array of strings

 * **Parameters:** `Dialect` — The dialect to use.

##### `public function getDialect() :? Dialect`

Returns the dialect of the database

 * **Returns:** `The` — dialect object.

##### `public function getHash() : string`

Returns the hash of the current object

 * **Returns:** `The` — hash of the password.

##### `public function getInstance()`

Returns the instance of the class

 * **Returns:** `The` — instance of the class.

##### `protected function setDialect(Dialect $dialect) : void`

The setDialect function sets the dialect property to the Dialect object passed in as a parameter

 * **Parameters:** `Dialect` — The dialect to use for the query.

##### `protected function setHash(string $hash) : void`

Set the hash of the password

 * **Parameters:** `string` — The hash of the file.

##### `protected function setInstance($instance) : void`

The setInstance function sets the instance variable to the value passed to it

 * **Parameters:** `instance` — instance of the class that is being instantiated.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details