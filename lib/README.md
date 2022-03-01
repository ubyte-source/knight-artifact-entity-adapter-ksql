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

> ## ***Class KSQL\Factory usable methods***

# Documentation

## `public static function connect(string $dialect = 'KSQL\\dialects\\MySQL', string $constant = 'DEFAULT') : Connection`

Creates a new connection to a database

 * **Parameters:**
   * `string` — The dialect to use.
   * `string` — The constant that will be used to identify the connection.

     <p>
 * **Returns:** `A` — connection object.

## `public static function disconnect(string $hash) : self`

This function disconnects a database from the pool

 * **Parameters:** `string` — The hash of the database to disconnect.

     <p>
 * **Returns:** `This` — class itself.

## `public static function dialHash(string ...$arguments) : string`

This function takes an array of strings and returns a hash of the array

 * **Returns:** `A` — string.

## `public static function searchConnectionFromHash(string $hash) :? Connection`

Given a hash, return the connection object that has that hash.

The function is a bit long, but it's not too bad. The first thing we do is loop through all of the connections in the static::array. If the hash is equal to the hash of the current connection, we return the connection. If we don't find a match, we return null

 * **Parameters:** `string` — The hash of the connection.

     <p>
 * **Returns:** `A` — Connection object or null.

> ## ***Class KSQL\Initiator usable methods***

# Documentation

## `public static function getNamespaceName() : string`

Returns the namespace name of the class

 * **Returns:** `The` — namespace name of the class.

## `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — object itself.

## `public function __call(string $method, array $arguments) : Base`

If the method called is a valid operation, create an instance of the operation class and return it

 * **Parameters:**
   * `string` — The method name that was called.
   * `array` — The arguments passed to the method.

     <p>
 * **Returns:** `An` — instance of the operation class.

## `public static function start(?Connection $connection, Table $table) : self`

This function creates a new instance of the class and sets the connection and table properties

 * **Parameters:**
   * `connection` — connection to use. If not specified, the default connection will be used.
   * `Table` — The table object that we're going to be working with.

     <p>
 * **Returns:** `An` — instance of the class.

## `public function getTable() : Table`

Returns the table object associated with this class

 * **Returns:** `The` — table object.

## `public function getConnection() :? Connection`

Returns the connection object

 * **Returns:** `A` — connection object.

> ## ***Class KSQL\Statement usable methods***

# Documentation

## `public function __construct(Connection $connection = null)`

The constructor function takes a Connection object as a parameter. If no Connection object is passed, it creates a new Connection object

 * **Parameters:** `Connection` — The connection to use for this query. If null, the default

     connection will be used.

## `public function __call(string $method, array $arguments)`

If the method exists on the connection, call it

 * **Parameters:**
   * `string` — The name of the method that was called.
   * `array` — The arguments passed to the method.

     <p>
 * **Returns:** `The` — connection object.

## `public function get() : string`

Returns the value of the sintax property

 * **Returns:** `The` — string that is being returned is the string that was passed into the constructor.

## `public function append(string $string, bool $white = true) : self`

Append a string to the sintax

 * **Parameters:**
   * `string` — The string to append to the sintax.
   * `bool` — If true, appends a space after the string.

     <p>
 * **Returns:** `Nothing.` — 

## `public function set(string $string) : self`

The set function sets the sintax property to the string passed to it

 * **Parameters:** `string` — The string to be parsed.

     <p>
 * **Returns:** `Nothing.` — 

## `public function concat(?self $statement) : self`

If the statement is null, return this. Otherwise, append the statement's query to this query and push the statement's bind parameters to this query's bind parameters

 * **Parameters:** `statement` — statement to append to the current statement.

     <p>
 * **Returns:** `The` — same instance of the class.

## `public function getConnection() :? Connection`

Returns the connection object

 * **Returns:** `A` — connection object.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details