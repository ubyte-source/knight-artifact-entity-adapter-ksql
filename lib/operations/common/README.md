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

###### ***Class KSQL\operations\common\Base usable methods***

##### `final public function __clone()`

It clones the object and all of its properties

 * **Returns:** `Nothing.` — 

##### `final public function __construct(Initiator $core, array $arguments)`

The __construct function is called when a new instance of the class is created

 * **Parameters:**
   * `Initiator` — The core object.
   * `array` — An array of arguments passed to the constructor.

###### ***Class KSQL\operations\common\Handling usable methods***

##### `public function run()`

The function runs the queries and returns the result of the last query

 * **Returns:** `The` — result of the last query executed.

##### `public function setSkip(Table ...$skip) : self`

The setSkip function sets the skip property of the class to the value of the skip parameter

 * **Returns:** `Nothing.` — 

###### ***Class KSQL\operations\common\Option usable methods***

##### `public static function getConstants(string $instance) : array`

Get all the constants from a class

 * **Parameters:** `string` — The instance of the class you want to get the constants of.

 * **Returns:** `An` — array of constants.

##### `public function __construct(Table $table)`

The constructor for the class

 * **Parameters:** `Table` — The table object that is being used to create the table.

##### `public function getTable() : Table`

Returns the table object associated with this object

 * **Returns:** `The` — table object.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details