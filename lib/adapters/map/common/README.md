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

> ## ***Class KSQL\adapters\map\common\Bind usable methods***

#### Documentation

##### `public function getBind() : array`

This function returns the bind array

 * **Returns:** `An` — array of values that are bound to the query.

##### `public function resetBind() : self`

This function resets the bind array

 * **Returns:** `The` — object itself.

##### `public function getBound(...$data) : array`

This function returns an array of bind variables that are bound to the data passed in

 * **Returns:** `An` — array of bound variables.

##### `public function addBind(string $key, $data) : self`

Add a bind value to the query

 * **Parameters:**
   * `string` — The name of the variable to bind.
   * `data` — data to be bound to the query.

     <p>
 * **Returns:** `Nothing.` — 

##### `public function pushFromBind(self ...$binds) : self`

This function takes an array of binds and adds them to the current bind

 * **Returns:** `Nothing.` — 

##### `private static function increment() : int`

Increment the static variable by 1

 * **Returns:** `The` — return value is an integer that is incremented by 1 each time the function is called.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details