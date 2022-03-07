# Documentation knight-artifact-entity-adapter-ksql

> Knight PHP library for build query in SQL; the default dialect implement is MySQL.

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

#### ***Class KSQL\operations\select\Alias usable methods***

##### `public function __construct(Table $table)`

The constructor for the class

 * **Parameters:** `Table` — The table to be used by the model.

##### `public function setName(string $name) : string`

Set the name of the alias to the given name.

 * **Parameters:** `string` — The name of the parameter.

 * **Returns:** `The` — object itself.

##### `public function getName() : string`

Get the name of the person.

 * **Returns:** `The` — name of the alias.

#### ***Class KSQL\operations\select\Group usable methods***

##### `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — object itself.

##### `public function setHaving(Dialect $dialect, ?string $having, string ...$data) : self`

It takes a string, replaces all instances of the variable prefix with the bound variable, and returns the string

 * **Parameters:**
   * `Dialect` — The dialect to use.
   * `having` — SQL having clause.

 * **Returns:** `The` — query object.

##### `public function getHaving() :? string`

Returns the having clause of the query

 * **Returns:** `The` — having clause of the query.

##### `public function setCollections(Collection ...$collections) : self`

The function takes in an array of collections and sets the collections property to that array

 * **Returns:** `Nothing.` — 

##### `public function addCollections(Collection ...$collections) : self`

AddCollections() adds a collection to the array of collections

 * **Returns:** `Nothing.` — 

##### `public function getColumns(?Select $select = null, bool $name = false) : array`

It returns the columns of the collections

 * **Parameters:**
   * `select` — Select object that will be used to get the columns.
   * `bool` — If true, the function will return an array of column names instead of an array

     of column definitions.

 * **Returns:** `The` — columns of the tables in the database.

#### ***Class KSQL\operations\select\Join usable methods***

##### `public function __construct(Table $table)`

Constructor for the inner join

 * **Parameters:** `Table` — The table object that is being joined.

##### `public function setType(int $type) : self`

Set the type of join.

 * **Parameters:** `int` — The type of join.

 * **Returns:** `Nothing.` — 

##### `public function getType() : int`

Get the type of the object

 * **Returns:** `The` — type of the question.

##### `public function addCondition(string $condition) : self`

Add a condition to the query

 * **Parameters:** `string` — The condition to add to the query.

 * **Returns:** `The` — object itself.

##### `public function getConditions() : array`

Returns the conditions array

 * **Returns:** `An` — array of conditions.

##### `public function getConditionsBuilded() :? string`

This function returns the conditions that are used in the ON statement

 * **Returns:** `The` — conditions that are being used in the join.

##### `public function setUsingList(bool $enable = true) : self`

The setUsingList function sets the using property to the value of the enable parameter

 * **Parameters:** `bool` — If true, the list will be used. If false, the list will be ignored.

 * **Returns:** `Nothing.` — 

##### `public function getUsingList() : bool`

Returns the value of the using property

 * **Returns:** `A` — boolean value.

##### `public function getAlias() : Alias`

Get the alias of this joined table.

 * **Returns:** `The` — Alias joined table.

##### `public function getFieldParsed(string $name) : string`

Returns the name of the field in the table, with the table alias prepended

 * **Parameters:** `string` — The name of the field to be parsed.

 * **Returns:** `The` — field name with the table alias.
 
#### ***Class KSQL\operations\select\Limit usable methods***

##### `public function set(int $limit) : self`

Set the limit of the query.

 * **Parameters:** `int` — The maximum number of results to return.

 * **Returns:** `Nothing.` — 

##### `public function get() :? int`

Get the value of the limit property.

 * **Returns:** `The` — limit value.

##### `public function setOffset(int $offset) : self`

Set the offset of the current status

 * **Parameters:** `int` — The number of seconds to offset the time by.

 * **Returns:** `Nothing.` — 

##### `public function getOffset() :? int`

Get the offset of the current position in the file.

 * **Returns:** `The` — offset of the current position in the file.

#### ***Class KSQL\operations\select\Order usable methods***

##### `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — object itself.

##### `public function pushDirections(Direction ...$directions) : self`

The function takes an array of Direction objects and pushes them into the collections array

 * **Returns:** `Nothing.` — 

##### `public function pushFields(Field ...$fields) : self`

This function adds a field to the collection of fields

 * **Returns:** `Nothing.` — 

##### `public function getColumns(?Select $select) : array`

This function returns an array of Column objects that are associated with this table

 * **Parameters:** `select` — Select object that is being used to generate the SQL.

 * **Returns:** `An` — array of strings.

##### `public function getCollections() : array`

This function returns an array of all the collections in this order statement

 * **Returns:** `An` — array of collection objects.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details