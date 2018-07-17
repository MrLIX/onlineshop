# Paycom integration template

This is not a complete implementation of the Marchant API, instead a basic template.
One **MUST** implement all the `todo:` entries found in the source files according his/her own requirements.

## Table of Content

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Transactions table](#transactions-table)
- [Orders table](#orders-table)
- [Additional resources](#additional-resources)
- [Endpoint](#endpoint)
- [File Structure](#file-structure)
- [Set Up and Run Merchant API implementation on Docker Containers](#set-up-and-run-merchant-api-implementation-on-docker-containers)
- [Contributing](#contributing)

## Prerequisites

- `PHP 5.4` or greater
- `MySQL` or `MariaDB` latest stable version
- [PDO](http://php.net/manual/en/book.pdo.php) extension
- [Composer](https://getcomposer.org/download/) dependency manager

## Installation

Copy the sample config file as `paycom.config.php` and adjust the settings according to your needs:

```bash 
$ cp paycom.config.sample.php paycom.config.php
```

Edit `paycom.config.php` and set your settings there:

- Set `merchant_id`;
- Do not change the `login`, it is always `Paycom`;
- Set a path to the password file in the `keyFile`;
- Adjust connection settings in the `db` key to your `mysql` database.

Following is an example `paycom.config.php` configuration file content:

```php
<?php
return [
    'merchant_id' => '69240ea9058e46ea7a1b806a',
    'login'       => 'Paycom',
    'keyFile'     => 'password.paycom',
    'db'          => [
        'host'     => 'localhost',
        'database' => 'db_shop',
        'username' => 'db_shop_admin',
        'password' => 'bh6U8M8tR5sQGsfLVHdB'
    ],
];
```

and an example `password.paycom` file content:

```
fkWW6UNrzvzyV6DhrdHJ6aEhr3dRcvJYkaGx
```

If you need to adjust other database settings, such as character set, you can do that in the `Paycom/Database.php` file.

### Transactions table

This template requires `transactions` table at least with the following structure:

```sql
CREATE TABLE `transactions` (
  `id`                    INT(11)      NOT NULL AUTO_INCREMENT,
  `paycom_transaction_id` VARCHAR(25)  NOT NULL COLLATE 'utf8_unicode_ci',
  `paycom_time`           VARCHAR(13)  NOT NULL COLLATE 'utf8_unicode_ci',
  `paycom_time_datetime`  DATETIME     NOT NULL,
  `create_time`           DATETIME     NOT NULL,
  `perform_time`          DATETIME     NULL     DEFAULT NULL,
  `cancel_time`           DATETIME     NULL     DEFAULT NULL,
  `amount`                INT(11)      NOT NULL,
  `state`                 TINYINT(2)   NOT NULL,
  `reason`                TINYINT(2)   NULL     DEFAULT NULL,
  `receivers`             VARCHAR(500) NULL     DEFAULT NULL COMMENT 'JSON array of receivers' COLLATE 'utf8_unicode_ci',
  `order_id`              INT(11)      NOT NULL,

  PRIMARY KEY (`id`)
)

COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;
```

Additional fields can be added into this table or above data types and sizes can be adjusted.

### Orders table

You also need a table to store info about orders.
Here is a sample table definition:

```sql
CREATE TABLE orders
(
  id          INT AUTO_INCREMENT PRIMARY KEY,
  amount      DECIMAL(18, 2) NOT NULL,
  state       TINYINT(1)     NOT NULL,
  user_id     INT            NOT NULL,
  phone       VARCHAR(15)    NOT NULL
) ENGINE = InnoDB;
```

Additional fields can be added into this table or above data types and sizes can be adjusted.

## Additional resources

- To test your [Merchant API](https://help.paycom.uz/pw/protokol-merchant-api) implementation we highly recommend using the following tools: 
  - [Test Merchant Cabinet](http://merchant.test.paycom.uz);
  - [Merchant Sandbox](http://test.paycom.uz/).
- For production use [Merchant Cabinet](https://merchant.paycom.uz).

## Endpoint

In the merchant cabinet on the cashbox settings point the `endpoint` to your Merchant API implementation.
Assuming your domain is `https://example.com`, and your `Merchant API` implementation is located under `api/` folder 
or a URL rewriting is configured to access API by `https://example.com/api/`,  then `endpoint` should be set as `https://example.com/api/index.php`.

## File Structure

Following is the brief description of the files:

| File/Folder                | Description                                                                               |
| -------------------------- | ----------------------------------------------------------------------------------------- |
| `index.php`                | An entry script, that loads configuration, initializes and runs an application instances. |
| `paycom.config.sample.php` | Sample configuration file with fake values.                                               |
| `paycom.config.php`        | Configuration file with actual values. Initially isn't present. Should be copied from `paycom.config.sample.php` |
| `paycom.password`          | Default file to set the `KEY` obtained from the Merchant Cabinet. Set in the config file via `keyFile`. Remove any whitespaces and `EOL` characters before save. |
| `functions.php`            | Contains additional functions. Right now it has only one function to retrieve headers from `$_SERVER` superglobal variable on Apache and Nginx. |
| `Paycom/`                  | A folder, that contains all required and helper classes.                                  |
| `Application.php`          | A main class to instantiate the new application and handle all requests.                  |
| `Database.php`             | A class to setup the new connections to the underlying database.                          |
| `Request.php`              | A helper class to parse request's payload.                                                |
| `Response.php`             | A helper class to send responses to the requester.                                        |
| `Format.php`               | A utility class to format data.                                                           |
| `Transaction.php`          | A class to handle transaction related tasks. Contains `todo: ` items that must be implemented. |
| `Merchant.php`             | A helper class to authorize requesters of the API.                                        |
| `PaycomException.php`      | A custom exception class to send error responses.                                         |
| `Order.php`                | A class to handle order/service related tasks.                                            |
| `vendor/`                  | Auto generated with Composer folder that contains autoloader.                             |
| `Dockerfile`               | Dockerfile to build an image with `PHP v7`, `Apache v2.4`, `Composer`.                    |
| `docker-compose.yml`       | Compose file to easily setup & run Merchant API implementation on the docker containers.  |
| `.gitignore`               | Git ignore file.                                                                          |
| `composer.json`            | Config file to handle dependencies and autoloader. Read more [here](https://getcomposer.org/doc/04-schema.md) |
| `README.md`                | Description and documentation of this template.                                           |

## Set Up and Run Merchant API implementation on Docker Containers

In cases that there is no `PHP`/`Apache`/`Nginx`/`MySQL` on your production platforms you can easily and quickly setup and run the `Merchant API` implementation using docker containers.

Here we will build docker images for `Paycom Merchant API` and optionally for `MySQL`.

`Dockerfile` contains statements to build an image for `Merchant API`.
This image is based on `PHP v7` and `Apache 2.4`, but also includes `PDO` and `PDO_MYSQL` extensions.
There are also statements to install the latest version of `Composer`.

By editing `docker-compose.yml` file you can adjust exposed ports, volumes.

If you need more info about base images and docker commands look at the following links:

- [Official php:7-apache docker image](https://hub.docker.com/_/php/);
- [Official mysql docker image](https://hub.docker.com/_/mysql/);
- [Dockerfile reference](https://docs.docker.com/engine/reference/builder/);
- [Docker Compose file reference](https://docs.docker.com/compose/compose-file/);
- [Docker Compose CLI reference](https://docs.docker.com/compose/reference/overview/);
- [Docker CLI reference](https://docs.docker.com/engine/reference/commandline/cli/).

Build the images:

```bash
docker-compose build
```

Run the containers:

```bash
docker-compose up -d
```

Show the logs:

```bash
docker-compose logs -f
```

Stop the containers:

```bash
docker-compose stop
```

Stop and remove the containers:

```bash
docker-compose down
```

Test the endpoint via cURL command:

```bash
curl -X POST \
  http://localhost:8888/ \
  -H 'Authorization: Basic UGF5Y29tOktleUZyb21NZXJjaGFudENhYmluZXQ=' \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -d '{
	"id": 1,
    "method" : "CheckPerformTransaction",
    "params" : {
        "amount" : 50000,
        "account" : {
            "phone" : "901304050"
        }
    }
}'
```

`Authorization` header contains `Base64` decoded `Paycom:KEY_FROM_CABINET` login and password.

For testing purposes you can quickly Base64 decode the login & password with [this online tool](https://www.base64encode.org/).

You should get something like the following response (below the response is formatted, but you will get raw responses):

```bash
{
    "id": 1,
    "result": null,
    "error": {
        "code": -31050,
        "message": {
            "ru": "Неверный код заказа.",
            "uz": "Harid kodida xatolik.",
            "en": "Incorrect order code."
        },
        "data": "order_id"
    }
}
```

## Contributing

PRs are welcome. GL&HF!
