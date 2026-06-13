# Mantenedor de Productos y Precios Funerarios

Sistema web desarrollado con Laravel para administrar el catálogo comercial de productos y planes funerarios, incluyendo control de estado e historial de precios.

## Funcionalidades

* Inicio de sesión y control de acceso mediante sesiones.
* Redirección automática según el estado de la sesión.
* Cierre de sesión con invalidación de sesión y cookie.
* Dashboard con cantidad total de productos, activos e inactivos.
* Listado de productos y planes funerarios.
* Registro de nuevos productos.
* Edición de productos existentes.
* Activación y desactivación sin eliminación física.
* Búsqueda por nombre y categoría.
* Validaciones del lado del servidor en español.
* Categorías controladas mediante listas desplegables.
* Administración del precio vigente.
* Registro histórico de precios.
* Formato monetario en pesos chilenos, CLP.
* Interfaz basada en AdminLTE 4.

## Tecnologías utilizadas

* PHP 8.2
* Laravel 12
* MySQL / MariaDB
* HTML5
* CSS3
* JavaScript
* Fetch API
* AdminLTE 4
* XAMPP
* Composer

## Requisitos

* PHP 8.2 o superior.
* Composer.
* MySQL o MariaDB.
* XAMPP, Laragon o un entorno equivalente.
* Extensiones de PHP requeridas por Laravel.

## Instalación

### 1. Copiar o clonar el proyecto

Ubicar el proyecto dentro de la carpeta del servidor local. Por ejemplo:

```text
C:\xampp\htdocs\
```

### 2. Instalar las dependencias

Desde la carpeta del proyecto ejecutar:

```powershell
composer install
```

### 3. Crear el archivo de entorno

En Windows:

```powershell
copy .env.example .env
```

### 4. Generar la clave de Laravel

```powershell
php artisan key:generate
```

### 5. Crear la base de datos

Iniciar Apache y MySQL desde XAMPP.

Crear en phpMyAdmin una base de datos llamada:

```text
mantenedor_productos
```

### 6. Importar el archivo SQL

Importar en la base de datos el archivo:

```text
mantenedor_productos.sql
```

El archivo incluye la estructura de las tablas y los datos utilizados para las pruebas.

No es necesario ejecutar `php artisan migrate` después de importar el archivo SQL completo.

### 7. Limpiar la configuración almacenada

```powershell
php artisan optimize:clear
```

### 8. Iniciar el proyecto

```powershell
php artisan serve
```

Abrir en el navegador:

```text
http://127.0.0.1:8000
```

## Credenciales de acceso

```text
Correo: admin@crm.cl
Contraseña: 123456
```

## Configuración de la base de datos

El archivo `.env.example` está configurado para utilizar MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mantenedor_productos
DB_USERNAME=root
DB_PASSWORD=
```

## Entidades principales

### Productos

Contiene la información general del catálogo:

* Nombre.
* Categoría.
* Precio vigente.
* Stock.
* Descripción.
* Estado activo o inactivo.

### Precios de producto

Mantiene el historial de precios:

* Producto relacionado.
* Precio.
* Fecha de inicio.
* Fecha de término.
* Precio vigente o histórico.

## Categorías disponibles

* Planes.
* Urnas.
* Lápidas.
* Flores.
* Accesorios.

## Control de estado

El sistema no elimina físicamente los productos. Los registros se mantienen en la base de datos y pueden alternarse entre:

* Activo.
* Inactivo.

El cambio se realiza mediante JavaScript, Fetch API y una petición HTTP PATCH.

## Autor

Ian Andre Jeldres Jofré 
Ingeniería Civil Informática 7mo semestre
Asignatura Desarrollo web y aplicaciones moviles

