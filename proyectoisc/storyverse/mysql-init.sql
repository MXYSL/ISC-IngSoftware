-- Inicialización de la base de datos StoryVerse

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS storyverse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE storyverse;

-- Crear usuario adicional si no existe
CREATE USER IF NOT EXISTS 'storyverse_user'@'%' IDENTIFIED BY 'storyverse_password';

-- Otorgar permisos
GRANT ALL PRIVILEGES ON storyverse.* TO 'storyverse_user'@'%';
GRANT ALL PRIVILEGES ON storyverse.* TO 'root'@'%';

-- Aplicar cambios
FLUSH PRIVILEGES;

-- Configuraciones adicionales para MySQL
SET GLOBAL sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO';

-- Crear tabla de sesiones si no existe (Laravel la creará automáticamente)
-- Esta es solo una referencia, Laravel manejará las migraciones

-- Optimizaciones para Laravel
SET GLOBAL innodb_file_format = Barracuda;
SET GLOBAL innodb_file_per_table = ON;