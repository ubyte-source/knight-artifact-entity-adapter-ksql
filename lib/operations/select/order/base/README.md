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

###### ***Class KSQL\operations\select\order\base\Column usable methods***

##### `public function __construct(Table $table, string $name)`

The constructor for the class

 * **Parameters:**
   * `Table` — The table object that this column belongs to.
   * `string` — The name of the column.

##### `public function getName() : string`

"Get the name of the column."

 * **Returns:** `The` — name of the object.

##### `public function getNameElaborate(?Select $select) : string`

Returns the name of the column, with a prefix of the table name if the column is not in the group

 * **Parameters:** `select` — Select object that is being built.

 * **Returns:** `The` — field name, with a preceding underscore, if the field is not in the group.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details