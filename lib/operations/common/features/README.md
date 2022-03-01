# Documentation knight-artifact-entity-adapter-ksql

> Knight PHP library for build query in SQL; the default dialect implement is MySQL.

**NOTE:** This repository is part of [Knight](https://github.com/energia-source/knight). Any
support requests, bug reports, or development contributions should be directed to
that project.

## Structure

- library:
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

## ***Class KSQL\operations\common\features\Parser usable methods***

#### Documentation

##### `public static function tables(Dialect $dialect, Table $data, string $origin, string ...$skip) : array`

It takes a Dialect, a Table, an origin, and an array of hashes. It then recursively calls itself on all of the Table's joined tables, and adds the resulting Query objects to an array

 * **Parameters:**
   * `Dialect` — The dialect to use.
   * `Table` — The table that we're going to be joining.
   * `string` — The table that is being joined to.

     <p>
 * **Returns:** `An` — array of Query objects.

##### `public static function uniqueness(Table $table) :? array`

This function returns the columns that are unique in the table

 * **Parameters:** `Table` — The table object.

     <p>
 * **Returns:** `An` — array of the columns that are unique.

##### `public static function getUniquenessMatch(Table $table, Table $child, bool $filtered = true) :? array`

It takes a table and a child table, and returns the fields that are unique to the child table

 * **Parameters:**
   * `Table` — The table that we're trying to match against.
   * `Table` — The child table.
   * `bool` — If true, only fields that are not null will be used.

     <p>
 * **Returns:** `An` — array of fields that are unique to the table.

 ## ***Class KSQL\operations\common\features\Where usable methods***

 #### Documentation

##### `public function setWhereStatement(Statement $statement) : self`

The setWhereStatement function takes a Statement object as a parameter and sets the where property to that object

 * **Parameters:** `Statement` — The statement to be used in the WHERE clause.

     <p>
 * **Returns:** `The` — object itself.

##### `public function where(Dialect $dialect, Table $data, string ...$skip) : Statement`

This function is responsible for generating the WHERE clause of the SQL statement

 * **Parameters:**
   * `Dialect` — The dialect object that will be used to generate the SQL.
   * `Table` — the table that is being queried

     <p>
 * **Returns:** `The` — statement object.

##### `public function pushTablesUsingOr(Table ...$tables) : int`

It pushes the tables into the tables array.

 * **Returns:** `The` — number of tables added to the array.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details