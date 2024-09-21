## Sistema de Inventario en Laravel

Este proyecto es un sistema de inventario desarrollado en Laravel 11.

## Instalación

1. Clonar el repositorio
```bash
git clone https://github.com/epajarito/technical-test
```

2. Instalar dependencias
```bash 
composer install
```

3. Crear archivo `.env` y configurar la conexión a la base de datos
```bash
cp .env.example .env
```

4. Generar la llave de la aplicación
```bash
php artisan key:generate
```

5. Ejecutar las migraciones y seeders (omitir si se desea usar la base de datos de prueba)
```bash
php artisan migrate:refresh --seed
```

6. Iniciar el servidor
```bash
php artisan serve
```

7. Iniciar el navegador y acceder a la URL
```bash
http://localhost:8000
```

### Acceso al sistema mediante FilamentPHP y Sistema tradicional

```bash
filament: http://localhost:8000/admin/login
sistema tradicional: http://localhost:8000/login
```

8. Acceder con las siguientes credenciales
```bash
Usuario: test@example.com
Contraseña: password
```
Este usuario tiene la capacidad de ver inventarios de otros usuarios, se concidera un usuario administrador.
En caso de generar un nuevo usuario solo podrá ver su inventario.


## Opcional ejecutar tests (pestPHP)
```bash
./vendor/bin/pest --parallel
```
## Bonus - Desarrollo de API

### NOTA: En caso de que se halla ejecutado los pasos anteriores, se debe ejecutar el siguiente comando
```bash
php composer install
php artisan migrate
```

## Adicional se generaron tests para la API
```bash
./vendor/bin/pest --parallel
```
### Endpoints de la API

| Endpoint                     | Descripción                   |
|------------------------------|-------------------------------|
| POST /api/auth/login         | Inicio de sessión             |
| POST /api/auth/register      | Creación de nueva cuenta      |
| GET /api/inventories         | Obtener todos los inventarios |
| POST /api/inventories        | Crear un inventario           |
| PUT /api/inventories/{id}    | Actualizar un inventario      |
| DELETE /api/inventories/{id} | Eliminar un inventario        |
