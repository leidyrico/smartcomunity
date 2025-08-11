# Configuración de Base de Datos - Smart Community

## Configuración Actual

La aplicación está configurada para conectarse a una base de datos MySQL con los siguientes parámetros:

- **Servidor:** 127.0.0.1 (localhost)
- **Puerto:** 3306
- **Base de datos:** smartcom
- **Usuario:** root
- **Contraseña:** (vacía)

## Archivos de Configuración

### 1. Archivo .env
El archivo `.env` contiene la configuración de conexión:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smartcom
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Archivo config/database.php
Laravel utiliza automáticamente las variables del archivo `.env` para configurar la conexión.

## Pasos para Configurar la Base de Datos

### Opción 1: Usando phpMyAdmin (Recomendado)

1. **Abrir XAMPP Control Panel**
   - Iniciar Apache
   - Iniciar MySQL

2. **Acceder a phpMyAdmin**
   - Ir a: http://localhost/phpmyadmin

3. **Crear la base de datos**
   - Hacer clic en "Nueva" en el panel izquierdo
   - Nombre de la base de datos: `smartcom`
   - Cotejamiento: `utf8mb4_unicode_ci`
   - Hacer clic en "Crear"

4. **Ejecutar el script SQL**
   - Seleccionar la base de datos `smartcom`
   - Ir a la pestaña "SQL"
   - Copiar y pegar el contenido del archivo `setup_database.sql`
   - Hacer clic en "Continuar"

### Opción 2: Usando MySQL Command Line

```bash
# Conectar a MySQL
mysql -u root -p

# Crear la base de datos
CREATE DATABASE smartcom CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Usar la base de datos
USE smartcom;

# Ejecutar el script
source C:/xampp/htdocs/smartcomunity/app-v.1/setup_database.sql;
```

## Verificar la Conexión

### 1. Archivo de Prueba PHP
Ejecutar en el navegador:
```
http://localhost/smartcomunity/app-v.1/test_db_connection.php
```

Este archivo verificará:
- ✅ Conexión a la base de datos
- ✅ Existencia de la tabla `users`
- ✅ Estructura de las tablas
- ✅ Conteo de registros

### 2. Usando Laravel Artisan (si Composer está instalado)
```bash
php artisan migrate:status
php artisan tinker
```

## Estructura de la Tabla Users

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint(20) UNSIGNED | ID único del usuario |
| name | varchar(255) | Nombre del usuario |
| email | varchar(255) | Email único del usuario |
| email_verified_at | timestamp | Fecha de verificación del email |
| password | varchar(255) | Contraseña hasheada |
| remember_token | varchar(100) | Token para "recordar sesión" |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de última actualización |

## Usuario de Prueba

El script crea automáticamente un usuario administrador:
- **Email:** admin@smartcom.com
- **Contraseña:** password (hasheada)

## Solución de Problemas

### Error: "Base de datos no encontrada"
1. Verificar que XAMPP esté ejecutándose
2. Verificar que MySQL esté iniciado
3. Crear la base de datos `smartcom` manualmente

### Error: "Acceso denegado"
1. Verificar las credenciales en el archivo `.env`
2. Verificar que el usuario `root` tenga permisos

### Error: "Tabla no encontrada"
1. Ejecutar el script `setup_database.sql`
2. Verificar que las tablas se crearon correctamente

## Archivos Relacionados

- `.env` - Configuración de conexión
- `config/database.php` - Configuración de Laravel
- `database/migrations/` - Migraciones de Laravel
- `app/Models/User.php` - Modelo de usuario
- `test_db_connection.php` - Archivo de prueba
- `setup_database.sql` - Script de creación de tablas

## Próximos Pasos

1. ✅ Configurar conexión a base de datos
2. ⏳ Ejecutar migraciones
3. ⏳ Configurar autenticación
4. ⏳ Crear seeders para datos de prueba
5. ⏳ Configurar rutas y controladores