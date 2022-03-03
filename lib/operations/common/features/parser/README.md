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

###### ***Class KSQL\operations\common\features\parser\Matrioska usable methods***

###### `public static function setClosure(Closure $callable) : void`

Set the closure to be called when the event is triggered

 * **Parameters:** `Closure` — The callable to be called when the event is triggered.

###### ***Class KSQL\operations\common\features\parser\Query usable methods***

###### `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — cloned object.

###### `final public function __construct(Table $table)`

The constructor for the class

 * **Parameters:** `Table` — The table object that this class is associated with.

###### `public function getTable() : Table`

Returns the table object associated with this class

 * **Returns:** `The` — table object.

###### `public function setStatement(Statement $statement) : self`

The setStatement function sets the statement property to the given statement

 * **Parameters:** `Statement` — The statement to be executed.

 * **Returns:** `The` — object itself.

###### `public function getStatement() :? Statement`

Returns the statement object associated with this object

 * **Returns:** `The` — statement object.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details