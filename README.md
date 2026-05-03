💈 AppSalon — Sistema de Gestión de Citas para Salón de Belleza
<div align="center">
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![SASS](https://img.shields.io/badge/SASS-CC6699?style=for-the-badge&logo=sass&logoColor=white)
![Gulp](https://img.shields.io/badge/Gulp-CF4647?style=for-the-badge&logo=gulp&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MVC](https://img.shields.io/badge/Arquitectura-MVC-0D6EFD?style=for-the-badge)
Plataforma web fullstack para la gestión de citas en salones de belleza, construida con PHP 8 y patrón de arquitectura MVC desde cero.
</div>
---
📋 Tabla de Contenidos
Descripción
Características
Stack Tecnológico
Arquitectura del Proyecto
Requisitos Previos
Instalación y Configuración
Estructura del Proyecto
Uso
Contribuciones
Licencia
---
📖 Descripción
AppSalon es una aplicación web fullstack desarrollada con PHP 8 que implementa el patrón de diseño MVC (Model-View-Controller) construido desde cero sin frameworks. Permite a los clientes registrarse, explorar servicios de un salón de belleza y reservar citas, mientras que el administrador puede gestionar la agenda del día y los servicios disponibles.
> Este proyecto fue desarrollado como práctica avanzada de desarrollo web backend con PHP puro, aplicando buenas prácticas de arquitectura de software.
---
✨ Características
👤 Panel de Cliente
Registro e inicio de sesión con autenticación segura
Exploración del catálogo de servicios (cortes, tintes, tratamientos, etc.)
Reserva de citas seleccionando fecha, hora y servicios
Gestión de citas propias (consultar, editar, cancelar)
🛠️ Panel de Administrador
Vista de agenda diaria con todas las citas registradas
Gestión completa del catálogo de servicios (CRUD)
Administración de usuarios registrados
⚙️ Técnicas
Arquitectura MVC implementada manualmente en PHP
Autoloading de clases con PSR-4 mediante Composer
ORM artesanal para consultas a MySQL
Compilación de SASS y minificación de assets con Gulp
Formularios validados en frontend y backend
Protección contra SQL Injection y CSRF
---
🧰 Stack Tecnológico
Capa	Tecnología
Backend	PHP 8.x
Base de datos	MySQL 8.x
Frontend	HTML5, CSS3/SASS, JavaScript ES6+
Automatización	Gulp 4
Gestor de dependencias	Composer (PSR-4), npm
Servidor local	Apache / XAMPP / Laragon
Patrón	MVC (sin framework)
---
🏗️ Arquitectura del Proyecto
El proyecto sigue el patrón MVC con un Router personalizado que mapea las URLs a sus respectivos controladores y métodos.
```
Petición HTTP
     │
     ▼
  Router (index.php)
     │
     ▼
 Controller  ◄────────►  Model (ActiveRecord / DB)
     │                        │
     ▼                        ▼
  View (HTML)              MySQL
```
Router: Parsea la URL y despacha al controlador correspondiente.
Model: Clases con métodos estáticos para interactuar con la base de datos.
Controller: Orquesta la lógica de negocio entre el modelo y la vista.
View: Plantillas PHP que renderizan el HTML final.
---
✅ Requisitos Previos
Asegúrate de tener instalados los siguientes programas:
PHP >= 8.0
MySQL >= 8.0
Composer >= 2.x
Node.js >= 16.x y npm
Servidor web local: XAMPP, Laragon o similar
---
🚀 Instalación y Configuración
1. Clonar el repositorio
```bash
git clone https://github.com/AngelAyal4/appsalon-phpmvc.git
cd appsalon-phpmvc
```
2. Instalar dependencias de PHP
```bash
composer install
```
3. Instalar dependencias de Node.js
```bash
npm install
```
4. Configurar el Virtual Host
Configura tu servidor local (Apache/XAMPP) para que el `DocumentRoot` apunte a la carpeta `/public` del proyecto:
```apacheconf
<VirtualHost *:80>
    ServerName appsalon.test
    DocumentRoot "C:/xampp/htdocs/appsalon-phpmvc/public"
    <Directory "C:/xampp/htdocs/appsalon-phpmvc/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
> Recuerda agregar `127.0.0.1 appsalon.test` en tu archivo `hosts`.
5. Configurar la base de datos
Crea una base de datos en MySQL y luego importa el archivo SQL incluido en el proyecto:
```bash
mysql -u root -p nombre_base_datos < database/appsalon.sql
```
Actualiza las credenciales en el archivo de configuración:
```php
// includes/database.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'appsalon');
```
6. Compilar assets con Gulp
```bash
# Compilación única
gulp

# Modo watch (recompila al guardar cambios)
gulp watch
```
7. Acceder a la aplicación
Abre tu navegador y visita:
```
http://appsalon.test
```
---
📁 Estructura del Proyecto
```
appsalon-phpmvc/
├── classes/                # Clases base del framework (Router, Model, Email)
├── controllers/            # Controladores de la aplicación
│   ├── AdminController.php
│   ├── APIController.php
│   ├── AuthController.php
│   └── CitasController.php
├── models/                 # Modelos que representan las tablas de BD
│   ├── Cita.php
│   ├── Servicio.php
│   └── Usuario.php
├── views/                  # Plantillas de vistas PHP
│   ├── admin/
│   ├── auth/
│   ├── citas/
│   └── layouts/
├── public/                 # DocumentRoot (único directorio público)
│   ├── index.php           # Front Controller
│   ├── build/              # Assets compilados (CSS, JS)
│   └── img/
├── src/                    # Assets fuente (SASS, JS sin compilar)
│   ├── scss/
│   └── js/
├── database/               # Script SQL de la base de datos
├── includes/               # Configuración y helpers globales
│   └── database.php
├── gulpfile.js             # Tareas de Gulp
├── composer.json
└── package.json
```
---
💻 Uso
Flujo del Cliente
Registro / Login — El usuario crea una cuenta o inicia sesión.
Nueva cita — Selecciona la fecha y los servicios deseados.
Confirmación — La cita queda registrada y puede gestionarla desde su panel.
Flujo del Administrador
Acceso al panel — Login con credenciales de administrador.
Ver agenda — Visualiza todas las citas del día actual.
Gestión de servicios — Agrega, edita o elimina servicios del catálogo.
---
🤝 Contribuciones
Las contribuciones son bienvenidas. Para contribuir:
Haz un fork del repositorio.
Crea una rama con tu feature: `git checkout -b feature/nueva-funcionalidad`
Commitea los cambios: `git commit -m 'feat: agrega nueva funcionalidad'`
Sube la rama: `git push origin feature/nueva-funcionalidad`
Abre un Pull Request describiendo los cambios.
Por favor, sigue la convención de commits Conventional Commits.
---
📄 Licencia
Este proyecto está bajo la licencia MIT. Consulta el archivo LICENSE para más detalles.
---
<div align="center">
Desarrollado por AngelAyal4
</div>
