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

## ***Class KSQL\dialects\MySQL usable methods***

All the files contain in the KSQL\dialects route are used by the library to build the query.

###### Documentation

######## `public static function Connection(string $constant = 'DEFAULT') : Connection`

This function returns a PDO connection object

 * **Parameters:** `string` — The name of the constant to use.

     <p>
 * **Returns:** `A` — PDO connection driver object.

######## `public static function BindCharacter() : string`

Returns the character 58

 * **Returns:** `The` — character 58.

######## `public static function ToJSON(Select $select) : string`

This function returns the JSON_OBJECT or JSON_ARRAYAGG function with the column names as the arguments

 * **Parameters:** `Select` — The Select object that we're converting to JSON.

     <p>
 * **Returns:** `The` — JSON_OBJECT function is being used to create a JSON object from the column names.

######## `public static function LastInsertID(Table $table) : string`

This function returns the last inserted ID of a table

 * **Parameters:** `Table` — The table object that we're inserting into.

     <p>
 * **Returns:** `The` — last insert id of the table.

######## `public static function AnyValue(string $elaborate) : string`

Returns the value of the specified element

 * **Parameters:** `string` — the name of the field to be used in the query.

     <p>
 * **Returns:** `The` — string 'ANY_VALUE(elaborate)'

######## `public static function FileReplacer(string $filtered) :? string`

This function takes a string and returns a string that is a base64 encoded version of the input string

 * **Parameters:** `string` — The string you want to replace.

     <p>
 * **Returns:** `The` — REPLACE function is being returned.

######## `public static function Limit(Statement $statement, Limit $limit) : void`

This function is used to limit the number of rows returned by a query

 * **Parameters:**
   * `Statement` — The statement object to append to.
   * `Limit` — The limit value.

     <p>
 * **Returns:** `Nothing.` — 

######## `public static function NaturalJoin(string $table) : string`

This function returns a string that is a natural join of the table name

 * **Parameters:** `string` — The table to join with the current table.

     <p>
 * **Returns:** `A` — string.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details