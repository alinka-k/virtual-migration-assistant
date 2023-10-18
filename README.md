# Virtual Migration Assistant Api Application

## DB Design
Design is placed in `database.dbml`

DBML syntax code [here](https://www.dbml.org/docs/#project-definition) 

## Swagger

Here you can find all for package - [Annotations](https://github.com/DarkaOnLine/L5-Swagger/blob/master/tests/storage/annotations/OpenApi/Anotations.php)

[OpenApi Doc](https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.0.md#path-item-object)

use ``php artisan l5-swagger:generate`` to generate docs

## Seed Db
Run the aggregated seeder to seed all the needed tables 
``` 
php artisan db:seed --class=DatabaseSeeder 
```
Or seed the tables separately:
To seed admin roles 
``` 
php artisan db:seed --class=RolesAndPermissionsSeeder 
```

## Fill in the eligibility programs table
Add the programs users will be evaluated for using the command:
``` 
php artisan eligibility:parse 
```

## IDE helper
generate PHP doc for models using Mixins
```
docker-compose exec php php artisan ide-helper:models -M
php artisan ide-helper:generate
php artisan ide-helper:meta
```
 
