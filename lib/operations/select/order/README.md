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

###### ***Class KSQL\operations\select\order\Direction usable methods***

##### `public function __construct(Table $table, string $name)`

The constructor for the class takes a table and a name, and sets the direction to ascending

 * **Parameters:**
   * `Table` — The table object that this column belongs to.
   * `string` — The name of the column.

##### `public function setDirection(int $direction) : self`

Set the direction of the order by clause.

 * **Parameters:** `int` — The direction of the order.

 * **Returns:** `Nothing.` — 

##### `public function getDirection() : int`

Get the direction of the column.

 * **Returns:** `The` — direction of the column.

##### `public function elaborate(?Select $select) : string`

This function returns the direction of the field

 * **Parameters:** `select` — Select object that is currently being elaborated.

 * **Returns:** `The` — direction of the field.

###### ***Class KSQL\operations\select\order\Field usable methods***

##### `public function __construct(Table $table, string $name)`

Constructor for the class

 * **Parameters:**
   * `Table` — The table that this column belongs to.
   * `string` — The name of the column.

##### `public function setOptions(string ...$options) : self`

This function sets the options for the field

 * **Returns:** `Nothing.` — 

##### `public function getOptions() : array`

This function returns the options array

 * **Returns:** `An` — array of options.

##### `public function elaborate(?Select $select) : string`

This function returns the options for the field

 * **Parameters:** `select` — Select object that is currently being elaborated.

 * **Returns:** `The` — field name and the options.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details