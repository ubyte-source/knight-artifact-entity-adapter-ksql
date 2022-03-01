# Documentation knight-artifact-entity-adapter-ksql

> Knight PHP library for build query in SQL; the default dialect implemented is MySQL.

**NOTE:** This repository is part of [Knight](https://github.com/energia-source/knight). Any
support requests, bug reports or development contributions should be directed to
that project.

## Installation

To begin, install the preferred dependency manager for PHP, [Composer](https://getcomposer.org/).

Now to install just this component:

```sh
$ composer require knight/knight-artifact-entity-adapter-ksql
```

## Extensions

--

## Configuration

### Concepts

Configuration are grouped into configuration namespace by the framework [Knight](https://github.com/energia-source/knight).
The configuration files are stored in the configurations folder and in the file named MySQL.php or Dielect.php that you have previously imported.

### Setup

So the basic setup looks something like this:

```

<?PHP

namespace configurations;

use Knight\Lock;

use KSQL\dialects\MySQL as Define;

final class MySQL
{
	use Lock;

	const DEFAULT = [
		// default server endpoint database name
		Define::CONFIGURATION_DATABASE => 'database',
		// default server endpoint database username
		Define::CONFIGURATION_DATABASE_USERNAME => 'database_username',
		// default server endpoint database password
		Define::CONFIGURATION_DATABASE_PASSWORD => 'password',
		// default server endpoint
		Define::CONFIGURATION_HOST => '127.0.0.1',
		// default server endpoint port
		Define::CONFIGURATION_PORT => 3306
	];
}

```

## Structure

- library:
    - [KSQL\adapters\map\common\Bind](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/map/common/Bind)
    - [KSQL\adapters\map\Injection](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/map/Injection)
    - [KSQL\adapters\map\JoinTables](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/map/JoinTables)
    - [KSQL\adapters\Join](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/adapters/Join)
    - [KSQL\connection\drivers\PDO](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/connection/drivers/PDO)
    - [KSQL\connection\Common](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/connection/Common)
    - [KSQL\dialects\constraint\Dialect](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/dialects/constraint/Dialect)
    - [KSQL\dialects\MySQL](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/dialects/MySQL)
    - [KSQL\entity\Table](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/entity/Table)
    - [KSQL\operations\common\features\parser\Matrioska](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/parser/Matrioska)
    - [KSQL\operations\common\features\parser\Query](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/parser/Query)
    - [KSQL\operations\common\features\Parser](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/Parser)
    - [KSQL\operations\common\features\Where](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/features/Where)
    - [KSQL\operations\common\Base](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/Base)
    - [KSQL\operations\common\Handling](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/Handling)
    - [KSQL\operations\common\Option](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/common/Option)
    - [KSQL\operations\select\group\Collection](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/group/Collection)
    - [KSQL\operations\select\order\base\Column](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/order/base/Column)
    - [KSQL\operations\select\order\Direction](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/order/Direction)
    - [KSQL\operations\select\order\Field](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/order/Field)
    - [KSQL\operations\select\Alias](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/Alias)
    - [KSQL\operations\select\Group](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/Group)
    - [KSQL\operations\select\Join](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/Join)
    - [KSQL\operations\select\Limit](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/Limit)
    - [KSQL\operations\select\Order](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/select/Order)
    - [KSQL\operations\Delete](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/Delete)
    - [KSQL\operations\Insert](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/Insert)
    - [KSQL\operations\Select](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/Select)
    - [KSQL\operations\Update](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/operations/Update)
    - [KSQL\Factory](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/Factory)
    - [KSQL\Initiator](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/Initiator)
    - [KSQL\Statement](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/lib/Statement)


## Usage

<br>

## ***Perform insert query***

<br>

> The most classic case is the insertion of a matryoshka; that is the insertion of a record in the main table where other daughter tables are connected. Connection by primary key is done automatically by the library.
So the basic insert table and childs table usage looks something like this:

<br>

```

<?PHP

namespace what\you\want;

use IAM\Sso;
use IAM\Configuration as IAMConfiguration;

use Knight\armor\Output;
use Knight\armor\Request;
use Knight\armor\Language;

use KSQL\Initiator as KSQL;
use KSQL\Factory;

use applications\document\output\forms\Matrioska;

$application_basename = IAMConfiguration::getApplicationBasename();
if (Sso::youHaveNoPolicies($application_basename . '/document/output/action/insert')) Output::print(false);

$matrioska = new Matrioska();
$matrioska->setFromAssociative((array)Request::post());

if (!!$errors = $matrioska->checkRequired(true)->getAllFieldsWarning()) {
    Language::dictionary(__file__);
    $notice = __namespace__ . '\\' . 'notice';
    $notice = Language::translate($notice);
    Output::concatenate('notice', $notice);
    Output::concatenate('errors', $errors);
    Output::print(false);
}

$database_connection = Factory::connect();
$database_connection->getInstance()->beginTransaction();

$matrioska_query = KSQL::start($database_connection, $matrioska);
$matrioska_query_insert = $matrioska_query->insert();
$matrioska_query_insert_response = $matrioska_query_insert->run();
if (null === $matrioska_query_insert_response) Output::print(false);

$database_connection->getInstance()->commit();

Output::print(true);

```

<br>

## ***Perform select query***

<br>

> In this example case we perform a select with a join for a child table where a specific field is taken and inserted as an array in the result of the main query.
So the basic select usage looks something like this:

<br>

```

<?PHP

namespace what\you\want;

use Knight\armor\Output;
use Knight\armor\Request;

use KSQL\Initiator as KSQL;
use KSQL\Factory;
use KSQL\dialects\MySQL;
use KSQL\operations\select\Join;
use KSQL\operations\select\group\Collection;

use applications\app\module\database\Main as Apn;
use applications\app\module\database\childs\Country;

$apn = new Apn();
$apn->setFromAssociative((array)Request::post());
$apn_fields = $apn->getFields();
foreach ($apn_fields as $field) $field->setRequired(true);

$apn_query = KSQL::start(Factory::connect(), $apn);

$country = new Country();
$country->setFromAssociative((array)Request::post());
$country_fields = $country->getFields();
foreach ($country_fields as $field) $field->setRequired(false);

$country_object = chr(96) . $country->getField('country')->getName() . chr(96);
$country_object = 'JSON_ARRAYAGG' . chr(40) . $country_object . chr(41);

$apn->join($country);
$apn_country_connect = new Join($country);
$apn_country_connect->setType(Join::LEFT);
$apn_country_connect->setUsingList(true);
$apn_country_connect->addCondition($apn->getField('id_apn')->getName());

$apn_query_select = $apn_query->select();
$apn_query_select->pushJoin($apn_country_connect);

$apn_query_select_limit = $apn_query_select->getLimit();
if (!!$count_offset = Request::get('offset')) $apn_query_select_limit->setOffset($count_offset);
if (!!$count = Request::get('count')) $apn_query_select_limit->set($count);

$apn_query_select_collection = new Collection($apn, $apn->getField('id_apn')->getName());
$apn_query_select->getGroup()->setCollections($apn_query_select_collection);
$apn_query_select_dialect = MySQL::instance();
$apn_query_select->getInjection()->addColumn($apn_query_select_dialect,
    $country->getField('country')->getName(),
    $country_object);

$apn_query_select_response = $apn_query_select->run();
if (null === $apn_query_select_response) Output::print(false);

var_dump($apn_query_select_response);

Output::print(true);

```
<br>

## ***Perform update query***

<br>

> In this case the syntax modifies the record in the parent table, deletes the records linked by the primary key and then inserts the new child records.
So the basic update table and delete/insert new childs record usage looks something like this:

<br>

```

<?PHP

namespace what\you\want;

use IAM\Sso;
use IAM\Configuration as IAMConfiguration;

use Knight\armor\Output;
use Knight\armor\Request;
use Knight\armor\Language;
use Knight\armor\Navigator;

use KSQL\Initiator as KSQL;
use KSQL\Factory;

use applications\document\output\database\Project;
use applications\document\output\forms\Matrioska;
use applications\document\output\database\project\Dependencies;

$application_basename = IAMConfiguration::getApplicationBasename();
if (Sso::youHaveNoPolicies($application_basename . '/what/you/wand/action/update')) Output::print(false);

$uniqueness = parse_url($_SERVER[Navigator::REQUEST_URI], PHP_URL_PATH);
$uniqueness = basename($uniqueness);

$matrioska = new Matrioska();
$matrioska->setFromAssociative((array)Request::post());
$matrioska->getField('uniqueness')->setProtected(false)->setRequired(true)->setValue($uniqueness);

if (!!$errors = $matrioska->checkRequired(true)->getAllFieldsWarning()) {
    Language::dictionary(__file__);
    $notice = __namespace__ . '\\' . 'notice';
    $notice = Language::translate($notice);
    Output::concatenate('notice', $notice);
    Output::concatenate('errors', $errors);
    Output::print(false);
}

$database_connection = Factory::connect();
$database_connection->getInstance()->beginTransaction();

$delete = [
    new Dependencies(),
];

foreach ($delete as $instance) {
    $instance->getField('uniqueness')->setProtected(false)->setValue($uniqueness);
    $instance_query = KSQL::start($database_connection, $instance);
    $instance_query_delete = $instance_query->delete();
    $instance_query_delete_response = $instance_query_delete->run();
    if (null === $instance_query_delete_response) Output::print(false);
}

$project = new Project();
$project->setFromAssociative((array)Request::post());
$project->getField('uniqueness')->setProtected(false)->setRequired(true)->setValue($uniqueness);
$project->getField('set_null_if_field_not_compile_and_not_required')->setRequired(true);
$project_query = KSQL::start($database_connection, $project);
$project_query_update = $project_query->update();
$project_query_update_response = $project_query_update->run();
if (null === $project_query_update_response) Output::print(false);

$matrioska_query = KSQL::start($database_connection, $matrioska);
$matrioska_query_insert = $matrioska_query->insert();
$matrioska_query_insert->setSkip($matrioska);
$matrioska_query_insert_response = $matrioska_query_insert->run();
if (null === $matrioska_query_insert_response) Output::print(false);

$database_connection->getInstance()->commit();

Output::print(true);

```

<br>

## ***Perform delete query***

<br>

> A foreign key with cascade delete means that if a record in the parent table is deleted, then the corresponding records in the child table will automatically be deleted.
So the basic delete record usage looks something like this:

<br>

```

<?PHP

namespace what\you\want;

use IAM\Sso;
use IAM\Configuration as IAMConfiguration;

use Knight\armor\Output;
use Knight\armor\Navigator;

use KSQL\Initiator as KSQL;
use KSQL\Factory;

use applications\coordinator\device\database\Device;

$application_basename = IAMConfiguration::getApplicationBasename();
if (Sso::youHaveNoPolicies($application_basename . '/what/you/wand/action/delete')) Output::print(false);

$device_serial = parse_url($_SERVER[Navigator::REQUEST_URI], PHP_URL_PATH);
$device_serial = basename($device_serial);

$device = new Device();
$device_fields = $device->getFields();
foreach ($device_fields as $field) $field->setRequired(false);
$device->getField('device_serial')->setProtected(false)->setRequired(true)->setValue($device_serial);

if (!!$errors = $device->checkRequired()->getAllFieldsWarning()) {
    Language::dictionary(__file__);
    $notice = __namespace__ . '\\' . 'notice';
    $notice = Language::translate($notice);
    Output::concatenate('notice', $notice);
    Output::concatenate('errors', $errors);
    Output::print(false);
}

$database_connection = Factory::connect();
$database_connection->getInstance()->beginTransaction();

$device_query = KSQL::start($database_connection, $device);
$device_query_delete = $device_query->delete();
$device_query_delete_response = $device_query_delete->run();
if (null === $device_query_delete_response
    || 1 !== $device_query_delete_response->rowCount()) Output::print(false);

$database_connection->getInstance()->commit();

Output::print(true);

```

<br>

## Built With

* [PHP](https://www.php.net/) - PHP

## Contributing

Please read [CONTRIBUTING.md](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/CONTRIBUTING.md) for details on our code of conduct, and the process for submitting us pull requests.

## Versioning

We use [SemVer](https://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/tags). 

## Authors

* **Paolo Fabris** - *Initial work* - [energia-europa.com](https://www.energia-europa.com/)
* **Gabriele Luigi Masero** - *Developer* - [energia-europa.com](https://www.energia-europa.com/)

See also the list of [contributors](https://github.com/energia-source/knight-knight-artifact-entity-adapter-ksql/blob/main/CONTRIBUTORS.md) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details