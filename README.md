# REST API for employee/manager Admin panel

> **tl;dr**☝️ **-** Need to create a REST API **without a frontend**. For employee/manager Admin panel inventory with notifications & access control

## Task summary

The task is to create a **REST API** without a frontend. The API should have features like **user management with roles**, **authentication and authorization**, **records inventory with access permissions**, and a **notification system**.

The API should allow users to **register as managers** and **create employees**. Employees should receive an **email notification** upon successful addition of records.

> **JWT tokens** should be used for authorization.

Employees can **create records** with `name` , `image` , and `category` . Managers can **see records created by their employees**. There should be **pagination** with 10 entries per page.  

Managers can **delete any record** created by their employees, while employees can **update and delete their records**. The database tables should be created using **migrations,** and the role names should be `manager` and `employee` .

* * *

## Features

1. User management with roles
2. Authentication & Authorization
3. Records inventory with access permissions
4. Notification system

## DOD

- [ ] The **user** can register as a manager.
- [ ] After register, it should be possible to create an employee.

> ❕ Create an employee model with two fields - `email address` and `password`.

- [ ] Send an email to the employee about the successful addition. Need to use notification and send notifications via a queue.
- [ ] Authorize the manager and employee, use `jwt` token.

> An `employee` user can create a `record` with the following fields:

*   `name`
*   `image`
*   `category`

> 💡 The list of categories must be filled in the Seeder.

- [ ] Once created, an employee can see a list of all `records` they have created, but cannot see records other employees have created.

> 👉 There should be **10** entries per page. Use Eloquent's paginate method for pagination.

- [ ] A manager can see a list of all records created by ONLY HIS employees.
- [ ] The employee will see a list of all the entries in the category they have created, and the manager will see a list of all the entries in that category that their employees have created.
- [ ] Also, the manager can see the `author` (creator) of the record and, by clicking on it, will see a list of all records of this employee (list his employee records).
- [ ] A manager can delete any record created by his employee.
- [ ] An employee can update and delete any of their records.

> ❗ Database tables must be created using `migration`.  
> 👉 Role names - `manager`, `employer`.

## Technical requirements:

*   PHP 7.4+
*   Laravel 8+
*   Mysql 8
*   Queues - database

### DB Schemes

1. User
2. Record

#### Useful Packages:

*   [https://packagist.org/packages/tymon/jwt-auth](https://packagist.org/packages/tymon/jwt-auth)

### Useful Laravel features:

*   Middleware
*   HTTP Requests
*   Notifications
*   Queues
*   Eloquent ORM
*   Database: Pagination
*   Database: Migrations
*   Database: Seeding
