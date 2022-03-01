# Documentation knight-artifact-entity-adapter-ksql

> Knight PHP library for build query in SQL; the default dialect implement is MySQL.

**NOTE:** This repository is part of [Knight](https://github.com/energia-source/knight). Any
support requests, bug reports, or development contributions should be directed to
that project.

## Structure

- library:
    - [KSQL\adapters\map\common](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/map/common/)
    - [KSQL\adapters\map](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/map/)
    - [KSQL\adapters](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/)
    - [KSQL\connection\drivers](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/connection/drivers/)
    - [KSQL\connection](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/connection/)
    - [KSQL\dialects\constraint](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/dialects/constraint/)
    - [KSQL\dialects](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/dialects/)
    - [KSQL\entity](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/entity/)
    - [KSQL\operations\common\features\parser](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/parser/)
    - [KSQL\operations\common\features](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/)
    - [KSQL\operations\common](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/)
    - [KSQL\operations\select\group](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/group/)
    - [KSQL\operations\select\order](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/order/)
    - [KSQL\operations\select](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/)
    - [KSQL\operations](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/)
    - [KSQL](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/)

> ## ***Class KSQL\operations\Delete usable methods***

# Documentation

## `public function getQueries() : array`

It takes a list of tables, and returns a list of queries

 * **Returns:** `An` — array of queries.

> ## ***Class KSQL\operations\Insert usable methods***

# Documentation

## `public function getQueries() : array`

It takes a list of tables, and returns a list of queries

 * **Returns:** `An` — array of queries.

## `public function setUpdate(bool $value = true) : self`

The setUpdate function sets the update property to the value passed in

 * **Parameters:** `bool` — The value to set the property to.

     <p>
 * **Returns:** `The` — object itself.

## `public function getUpdate() : bool`

Returns true if the update flag is set.

 * **Returns:** `A` — boolean value.

## `public function setIgnore(bool $value = true) : self`

Set the ignore flag to true or false.

 * **Parameters:** `bool` — The value to set the property to.

     <p>
 * **Returns:** `Nothing.` — 

## `public function getIgnore() : bool`

Get the value of the ignore property.

 * **Returns:** `A` — boolean value.

> ## ***Class KSQL\operations\Select usable methods***

# Documentation

## `public static function getTableName(Table $table, ?Alias $alias = null) : string`

Returns the name of the table

 * **Parameters:**
   * `Table` — The Table object that we're getting the table name for.
   * `alias` — alias of the table.

     <p>
 * **Returns:** `The` — table name.

## `public function pushJoin(Join ...$join) : self`

Add a join to the query

 * **Returns:** `The` — same object.

## `public function getJoin() : array`

Returns the join array

 * **Returns:** `An` — array of the join statements.

## `public function findJoin(Table $table) :? Join`

Find a join in the current query by table hash

 * **Parameters:** `Table` — The table to join.

     <p>
 * **Returns:** `A` — Join object or null.

## `public function setDistinct(bool $distinct = true) : self`

The setDistinct method sets the distinct property to the value passed in

 * **Parameters:** `bool` — If set to true, the query will be executed with a distinct clause.

     <p>
 * **Returns:** `The` — current instance of the class.

## `public function getInjection() : Injection`

Get the injection for this object.

 * **Returns:** `The` — injection object.

## `public function getGroup() : Group`

Get the group that this user belongs to.

 * **Returns:** `The` — group object that is associated with the question.

## `public function getOrder() : Order`

Get the order object.

 * **Returns:** `The` — Order object that is associated with the OrderItem.

## `public function getLimit() : Limit`

Get the limit.

 * **Returns:** `The` — limit object.

## `public function useAlias(string $name = null) : self`

Creates a new Alias object and sets it as the current alias for this QueryBuilder

 * **Parameters:** `string` — The name of the alias.

     <p>
 * **Returns:** `The` — current instance of the class.

## `public function getAlias() :? Alias`

Get the alias of this object.

 * **Returns:** `The` — alias object.

## `public function setFromStatement(Statement $statement) : self`

The setFromStatement function sets the from property of the class to the given statement

 * **Parameters:** `Statement` — The statement to be used as the FROM clause.

     <p>
 * **Returns:** `The` — object itself.

## `public function getTable() : Table`

Returns the table object for the current model

 * **Returns:** `A` — Table object.

## `public function getConnection() :? Connection`

Returns the connection object for the current request

 * **Returns:** `A` — connection object.

## `public function getFieldParsed(Table $table, string $name) : string`

Given a table, return the field name

 * **Parameters:**
   * `Table` — The table to get the field from.
   * `string` — The name of the field to get.

     <p>
 * **Returns:** `The` — field name.

## `public function getFrom() : string`

This function returns the table name of the current model

 * **Returns:** `The` — table name.

## `public function getStatement() : Statement`

This function returns a statement object that contains the SQL query that will be executed by the database

 * **Returns:** `The` — SQL statement.

## `public function run()`

This function runs the statement that was created in the constructor

 * **Returns:** `The` — statement object.

## `public function getAllColumns(Dialect $dialect, Table $data, bool $required = false, Group $group = null) : array`

This function will return all the columns from the table and all the joined tables

 * **Parameters:**
   * `Dialect` — The dialect to use for the query.
   * `Table` — The table that we are getting the columns from.
   * `bool` — If true, the column is required to be in the query.
   * `Group` — The group to which the columns belong.

     <p>
 * **Returns:** `The` — columns that are being returned are the columns that are being used in the query.

     This includes the columns that are being joined.

> ## ***Class KSQL\operations\Update usable methods***

# Documentation

## `public function getQueries() : array`

It returns an array of queries, each one of them is a statement that will be executed on the database

 * **Returns:** `An` — array of queries.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details