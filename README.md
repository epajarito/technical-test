## Sistema de Inventario en Laravel

Este proyecto es un sistema de inventario desarrollado en Laravel 8, con el objetivo de llevar un control de los productos de una empresa.

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

5. Ejecutar las migraciones y seeders
```bash
php artisan migrate --seed
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

## Opcional ejecutar tests (pestPHP)
```bash
./vendor/bin/pest --parallel
```
