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

#### ***Class KSQL\adapters\map\common\Injection usable methods***

##### `public function getColumns() : array`

Returns an array of the columns in the table

 * **Returns:** `An` — array of column names.

##### `public function reset() : self`

Resets the bind parameters and columns

 * **Returns:** The object itself.

##### `public static function getConstants(string $instance) : array`

Get all the constants from a class

 * **Parameters:** `string` — The instance of the class you want to get the constants of.

 * **Returns:** `An` — array of constants.

##### `public function addColumn(Dialect $dialect, string $field_name, string $value, ?string ...$data) : self`

It takes a field name and a value, and adds them to the columns array

 * **Parameters:**
   * `Dialect` — The dialect to use.
   * `string` — The name of the field to be added to the query.
   * `string` — The value to be inserted into the column.

 * **Returns:** `The` — current instance of the class.

So the basic add column code SQL injection into query:

```

<?PHP

...

$table = new Table();
$table_timestamp = $table->getField('timestamp');
$table_timestamp_name = $table_timestamp->getName();
$table_query_connection = Factory::connect(BigQuery::class);
$table_query = KSQL::start($table_query_connection, $table);
$table_query_connection_dialect = $table_query_connection->getDialect();

$table->getInjection()->addColumn($table_query_connection_dialect,
	$table_timestamp_name, '#name# > $0',
	$period->getField('time')->getValue());

...

```

##### `public function addColumnSelect(Dialect $dialect, string $field_name, Select $select, bool $json = false) : self`

This function adds a column to the select statement

 * **Parameters:**
   * `Dialect` — The dialect to use.
   * `string` — The name of the column to be added.
   * `Select` — The Select object that you want to add to the select statement.
   * `bool` — If true, the column will be treated as a JSON column.

 * **Returns:** `The` — column name.

So the basic add column code SQL injection into query from another query select statement:

```

<?PHP

...

$database_connection = Factory::connect();

$modernize = new Modernize();
$modernize_query = KSQL::start($database_connection, $modernize);
$modernize_query_select = $modernize_query->select();
$modernize_query_select->getLimit()->set(1);

$modernize_fields = $modernize->getFields();
foreach ($modernize_fields as $field) $field->setRequired(false);

$modernize_field_id_draw = $modernize->getField('id_draw');
$modernize_field_id_draw_name = $modernize_field_id_draw->getName();
$modernize_field_id_draw->setProtected(true)->setRequired(true);

$technical = new Technical();
$technical_fields = $technical->getFields();
foreach ($technical_fields as $field) $field->setRequired(false);

$database_connection->getInstance()->beginTransaction();

$technical_dialect = MySQL::instance();
$technical_query = KSQL::start($database_connection, $technical);
$technical->getInjection()->addColumnSelect($technical_dialect,
	$modernize_field_id_draw_name,
	$modernize_query_select);

$technical_query_update = $technical_query->update();

...

```

##### `public function getColumnsParsed(int $type, ?string $prefix = null) : array`

This function will return an array of the columns that are being used in the query

 * **Parameters:**
   * `int` — The type of the column.
   * `prefix` — prefix to use for the bind variables.

 * **Returns:** `The` — return value is an array of strings.

#### ***Class KSQL\adapters\map\common\JoinedTables usable methods***

##### `public function __clone()`

Clone the object and all its properties

 * **Returns:** `The` — object itself.

##### `public function pushTables(Table ...$tables) : int`

*This function pushes a table onto the tables array.*

 * **Returns:** `The` — number of tables pushed.

##### `public function getTablesByName(string ...$names) : array`

Given a list of table names, return a list of tables that match those names

 * **Returns:** `An` — array of Table objects.

##### `public function getTables() : array`

Returns an array of all the tables in the database

 * **Returns:** `An` — array of table names.

## Built With

* [PHP](https://www.php.net/) - PHP

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details