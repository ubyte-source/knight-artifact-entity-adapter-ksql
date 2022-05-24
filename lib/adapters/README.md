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

#### ***Class KSQL\adapters\Join usable methods***

##### `public function __construct()`

The constructor sets the injection and joined tables properties to null, and then instantiates a new Injection and JoinedTables object

##### `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — object itself.

##### `public function setInjection(?Table $table, Injection $injection) : self`

The setInjection function sets the injection property of the class to the injection parameter

 * **Parameters:**
   * `table` — table to inject into.
   * `Injection` — The injection to use.

 * **Returns:** `The` — current object.

##### `public function setJoinedTables(?Table $table, JoinedTables $tables) : self`

The setJoinedTables function sets the tables property to the tables parameter

 * **Parameters:**
   * `table` — table that is being joined.
   * `JoinedTables` — The tables that are joined.

 * **Returns:** `A` — new instance of the class.

##### `public function getInjection() : Injection`

Get the injection for this object.

 * **Returns:** `The` — injection object.

##### `public function getJoinedTables() : JoinedTables`

Returns the joined tables

 * **Returns:** `An` — instance of the JoinedTables class.

##### `public function join(?Table $table, Table ...$tables) : Table`

This function joins the table with the table passed in as an argument

 * **Parameters:** `table` — table to join with.

 * **Returns:** `The` — last table in the chain of joins.

So the basic add column code SQL injection into query:

```

<?PHP

...

$user = new User();
$user_fields = $user->getFields();
foreach ($user_fields as $field) $field->setRequired(true);

$database_connection = Factory::connect();

$user_query = KSQL::start($database_connection, $user);

$assignment = new Assignment();
$assignment->setFromAssociative((array)Request::post());
$assignment_fields = $assignment->getFields();
foreach ($assignment_fields as $field) $field->setRequired(false);

$assignment_object = chr(96) . $assignment->getField('country')->getName() . chr(96);
$assignment_object = 'JSON_ARRAYAGG' . chr(40) . $assignment_object . chr(41);

$user->join($assignment);
$user_assignment_connect = new Join($assignment);
$user_assignment_connect->setType(Join::LEFT);
$user_assignment_connect->setUsingList(true);
$user_assignment_connect->addCondition($user->getField('id_user')->getName());

$user_query_select = $user_query->select();
$user_query_select->pushJoin($user_assignment_connect);

$user_query_select_limit = $user_query_select->getLimit();
if (!!$count_offset = Request::get('offset')) $user_query_select_limit->setOffset($count_offset);
if (!!$count = Request::get('count')) $user_query_select_limit->set($count);

$user_query_select_collection = new Collection($user, $user->getField('id_user')->getName());
$user_query_select->getGroup()->setCollections($user_query_select_collection);
$user_query_select_dialect = MySQL::instance();
$user_query_select->getInjection()->addColumn($user_query_select_dialect,
    $assignment->getField('country')->getName(),
    $assignment_object);

...

```

##### `public function getFieldPath(?Table $table, string $name) : string`

Given a table and a field name, return the field path

 * **Parameters:**
   * `table` — Table object that contains the field.
   * `string` — The name of the field.

 * **Returns:** `The` — field path for the field in the table.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
