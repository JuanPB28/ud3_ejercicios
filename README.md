# Ejercicios UD3

## Ejercicios UD3.1 - Configuración

### Ejercicio 1 (1p)

Crea un repositorio en github con el nombre "ud3_ejercicios".

### Ejercicio 2 (1p)

Clona el repositorio "ud3_ejercicios" y crea un nuevo proyecto Laravel 11.x con las opciones "No starter kit" y "PHPUnit". Haz un commit con el msg "Hello World ejercicios UD3" y sube los cambios a github.

### Ejercicio 3 (1p)

Crea un fichero Dockerfile en el repositorio "ud3_ejercicios" para la configuración de la Base de datos con Docker del servicio [MariaDB](https://hub.docker.com/_/mariadb), con los siguiente parámetros:

- Nombre: mariadb-server
- Puertos: 3306
- Usuario: root
- Password: m1_s3cr3t

De tal manera que los siguientes comandos funcionen:

```bash
docker exec -it mariadb-server mariadb -u root -p
CREATE DATABASE test1;
SHOW DATABASES;
```

> (No es recomendable poner en el Dockerfile datos sensibles como la conatraseña)
> 
> Para que funcione los anteriores comandos hay que seguir los siguientes pasos:
> ```bash
> docker build -t mariadb .
> docker run -d -p 3306:3306 --name mariadb-server mariadb
> ```

### Ejercicio 4 (1p)

Revisa los ficheros de la carpeta `database/migrations` y contesta a las siguientes preguntas:

1. ¿Qué crees que hace el método `create` de la clase `Schema`?

    > Crear una tabla.

2. ¿Qué crees que hace `$table->string('email')->primary();`?

    > Crea una columna de tipo string con nombre 'email' la cual será la Primary Key de una base de datos SQL.

3. ¿Cuantas tablas hay definidas? Indica el nombre de cada tabla

    > En el archivo de migración de usuarios hay 3 tablas:
    >     users,
    >     password_reset_tokens,
    >     sessions
    > 
    > En el archivo de migración de cache hay 2 tablas:
    >     cache,
    >     cache_locks
    > 
    > En el archivo de migración de trabajos hay 3 tablas:
    >     jobs,
    >     job_batches,
    >     failed_jobs

### Ejercicio 5 (1p)

Modifica el `.env` de tu aplicación Laravel:

```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test1
DB_USERNAME=root
DB_PASSWORD=m1_s3cr3t
```
Nota: Si al ejecutar php artisan migrate aparece un error relacionado con el driver, puedes instalarlo con `sudo apt install php8.3-mysql`

Ejecuta los siguientes pasos y contesta a las preguntas:

1. Ejecuta el comando `php artisan config:clear` para limpiar y cachear la configuración de Laravel.
2. Ejecuta el comando `php artisan migrate` para crear las tablas por defecto definidas en la carpeta `database/migrations`
3. Muestra las tablas:

```bash
docker exec -it mariadb-server mariadb -u ig -p
USE test1;
SHOW TABLES;
```
> No se ha creado el usuario 'ig', así que he ejecutado el comando con el usuario 'root'

- ¿Cuántas tablas aparecen?

    | **Tables_in_test1**   |
    |-----------------------|
    | cache                 |
    | cache_locks           |
    | failed_jobs           |
    | job_batches           |
    | jobs                  |
    | migrations            |
    | password_reset_tokens |
    | sessions              |
    | users                 |

### Ejercicio 6 (1p)

Indica qué realiza los siguientes comandos:

- `php artisan migrate`:
    > Ejecuta todas las migraciones pendientes en la base de datos. Crea las tablas y columnas definidas en las migraciones.
- `php artisan migrate:status`:
    > Muestra el estado de cada migración, indicando si ha sido ejecutada o no.
- `php artisan migrate:rollback`:
    > Revierte la última operación de migración, deshaciendo los cambios realizados por la última migración ejecutada.
- `php artisan migrate:reset`:
    > Revierte todas las migraciones, deshaciendo todos los cambios realizados por todas las migraciones ejecutadas.
- `php artisan migrate:refresh`:
    > Revierte todas las migraciones y luego las vuelve a ejecutar. Es útil para restablecer la base de datos a su estado inicial.
- `php artisan make:migration`:
    > Crea un nuevo archivo de migración en el directorio database/migrations. Puedes especificar el nombre de la migración y opciones adicionales, como la creación de una tabla o la adición de columnas.
- `php artisan migrate --seed`:
    > Ejecuta todas las migraciones pendientes y luego ejecuta los seeders configurados para poblar la base de datos con datos de prueba.

### Ejercicio 7 (1p)

Crea la base de datos test2 y conecta tu aplicación a dicha base de datos. Emplea el comando `php artisan make:migration my_test_migration` para crear el fichero `database/migrations/<timestamp>_my_test_migration.php`. Abre el fichero y observa que hay dos métodos: `up()` y `down()`

Inserta el siguiente código en la función `up()`;

```php
Schema::create('alumnos', function (Blueprint $table) {
    $table->id(); 
    $table->string('nombre'); 
    $table->string('email')->unique(); 
    $table->timestamps(); 
});
```

y el siguiente en la función `down()`:

```php
Schema::dropIfExists('alumnos');
```

Ejecuta las migraciones con `php artisan migrate` y asegurate que existe la tabla:

```bash
docker exec -it mariadb-server mariadb -u ig -p
USE test2;
SHOW TABLES;
```
### Ejercicio 8 (1p)

¿Qué pasos debemos dar si queremos añadir el campo `$table->string('apellido');` a la tabla alumnos del ejercicio anterior?

> Hay dos formas de añadir el campo:

> **Deshacer la migración:**
> 1. Revertir la última migración con el comando ```php artisan migrate:rollback```.
> 2. Modificar el archivo de la migración (my_test_migration.php).
> ```php
> <?php
>
> use Illuminate\Database\Migrations\Migration;
> use Illuminate\Database\Schema\Blueprint;
> use Illuminate\Support\Facades\Schema;
>
> return new class extends Migration
> {
>     /**
>      * Run the migrations.
>      */
>     public function up(): void
>     {
>         Schema::create('alumnos', function (Blueprint $table) {
>             $table->id(); 
>             $table->string('nombre'); 
>             $table->string('apellido'); // Añadir el campo 'apellido'
>             $table->string('email')->unique(); 
>             $table->timestamps(); 
>         });
>     }
> 
>     /**
>      * Reverse the migrations.
>      */
>     public function down(): void
>     {
>         Schema::dropIfExists('alumnos');
>     }
> };
> ```
> 3. Ejecutar la migración nuevamente con el comando ```php artisan migrate```.

> **Crear una nueva migración:**
> 1. Utilizar el comando ```php artisan make:migration add_apellido --table=alumnos```.
> 2. Modificar la nueva migración.
> ```php
> <?php
> 
> use Illuminate\Database\Migrations\Migration;
> use Illuminate\Database\Schema\Blueprint;
> use Illuminate\Support\Facades\Schema;
> 
> return new class extends Migration
> {
>     /**
>      * Run the migrations.
>      */
>     public function up(): void
>     {
>         Schema::table('alumnos', function (Blueprint $table) {
>             $table->string('apellido')->after('nombre');
>         });
>     }
> 
>     /**
>      * Reverse the migrations.
>      */
>     public function down(): void
>     {
>         Schema::table('alumnos', function (Blueprint $table) {
>             $table->dropColumn('apellido');
>         });
>     }
> };
> ```
> 3. Ejecutar la migración con el comando ```php artisan migrate```.

### Ejercicio 9 (1p)

Con los siguientes comandos, podemos obtener el contenido de la tabla alumnos:

```bash
docker exec -it mariadb-server mariadb -u ig -p
USE test2;
SELECT * FROM alumnos;
```

Como podemos observar, la tabla `alumnos` no contiene datos. En Laravel, podemos crear datos de prueba de nuestra aplicación a través del `Seeder` (https://laravel.com/docs/11.x/seeding). Vamos a crear unos datos de prueba para la tabla alumnos:

1. Crea un nuevo seeder con el comando: `php artisan make:seeder AlumnosTableSeeder`
2. En el fichero que se ha creado en la carpeta `database/seeders` añade a la funcion `run()`:

```php
DB::table('alumnos')->insert([
    [
        'nombre' => 'Juan Pérez',
        'email' => 'juan.perez@example.com',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'nombre' => 'María González',
        'email' => 'maria.gonzalez@example.com',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'nombre' => 'Carlos López',
        'email' => 'carlos.lopez@example.com',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    ]);
```

3. Abre el archivo `database/seeders/DatabaseSeeder.php` y añade a la llamada al nuevo seeder en la función `run()`:

```php
$this->call(AlumnosTableSeeder::class);
```

4. Ejecuta: `php artisan db:seed`
5. Muestra el contenido de la tabla alumnos y comprueba que se han creado correctamente.

    | **id** | **nombre**     | **email**                  | **created_at**      | **created_at**      |
    |--------|----------------|----------------------------|---------------------|---------------------|
    | 1      | Juan Pérez     | juan.perez@example.com     | 2024-12-30 12:54:30 | 2024-12-30 12:54:30 |
    | 2      | María González | maria.gonzalez@example.com | 2024-12-30 12:54:30 | 2024-12-30 12:54:30 |
    | 3      | Carlos López   | carlos.lopez@example.com   | 2024-12-30 12:54:30 | 2024-12-30 12:54:30 |

## Conceptos clave para el Ejercicio 10

Modelar datos en un diagrama Entidad-Relación nos permite representar de manera gráfica y conceptual la estructura de los datos de un sistema. Este modelo se utiliza principalmente en la etapa de diseño de bases de datos para comprender, organizar y definir cómo se almacenarán los datos y cómo se relacionarán entre sí.

- Entidades: Representan objetos del mundo real que tienen existencia y de los cuales queremos almacenar información.
Ejemplo: Alumno, Asignatura, Profesor.

- Atributos: Son las propiedades o características que describen una entidad.
Ejemplo: Para la entidad Alumno, los atributos pueden ser id, nombre, email.

- Clave primaria (PK):
Es un atributo (o combinación de atributos) que identifica de manera única cada instancia de una entidad.
Ejemplo: id es la clave primaria de la entidad Alumno.

- Relaciones:
Representan las asociaciones entre dos o más entidades. Pueden ser:

    - Uno a uno (1:1): Cada registro de una entidad se asocia con un único registro de otra.
    - Uno a muchos (1:N): Un registro de una entidad puede relacionarse con varios registros de otra entidad.
    - Muchos a muchos (N:M): Varios registros de una entidad pueden relacionarse con varios registros de otra entidad. En este caso, se utiliza una tabla intermedia.

- Clave foránea (FK): Es un atributo que referencia a la clave primaria de otra tabla, permitiendo establecer relaciones entre entidades.

### Ejercicio 10 (1p)

Supongamos que trabajamos en una empresa que quiere implementar un sistema para gestionar las notas de los alumnos en diferentes asignaturas y os proporciona el siguiente diagrama E-R.

```bash
+-----------------+           +-----------------+           +-----------------+
|     Alumno      |           |     Nota        |           |   Asignatura    |
+-----------------+           +-----------------+           +-----------------+
| id (PK)         |<---+      | id (PK)         |      +--->| id (PK)         |
| nombre          |    +------| alumno_id (FK)  |      |    | nombre          |
| email           |           | asignatura_id(FK)|------+    | descripcion     |
+-----------------+           | nota            |           +-----------------+
                              | created_at      |
                              | updated_at      |
                              +-----------------+
```
Crea una base de datos llamada `gestion_notas` e implementa las tablas mediante migraciones de Laravel. Añade algunos datos de prueba mediante `Seeder`.
