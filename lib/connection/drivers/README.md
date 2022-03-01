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

> ## ***Class KSQL\connection\drivers\PDO usable methods***

#### Documentation

##### `public static function converter(&$value) : void`

If the value is an array or an object, convert it to a JSON string

 * **Parameters:** `value` — value to be converted.

     <p>
 * **Returns:** `The` — value of the field.

##### `public function __construct(Dialect $dialect, string ...$array)`

The constructor of this class will create a PDO object with the given parameters

 * **Parameters:** `Dialect` — The dialect to use.

##### `public function execute(Statement $statement)`

This function is responsible for preparing the statement and binding the parameters

 * **Parameters:** `Statement` — The statement object that is being executed.

     <p>
 * **Returns:** `The` — PDOStatement object.

##### `protected function getPrepare(string $statement) :? PDOStatement`

If the statement has already been prepared, return the prepared statement. Otherwise, prepare the statement and return the prepared statement

 * **Parameters:** `string` — The SQL statement to prepare.

     <p>
 * **Returns:** `A` — PDOStatement object.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details