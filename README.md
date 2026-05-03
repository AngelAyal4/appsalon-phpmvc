# 💈 AppSalon — Gestión de Citas para Salón de Belleza

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)

![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

![SASS](https://img.shields.io/badge/SASS-CC6699?style=for-the-badge&logo=sass&logoColor=white)

![Gulp](https://img.shields.io/badge/Gulp-CF4647?style=for-the-badge&logo=gulp&logoColor=white)

Aplicación web fullstack con **PHP 8** y arquitectura **MVC desde cero**. Permite a clientes reservar citas y al administrador gestionar la agenda y servicios del salón.

---

## ✨ Características

- Registro, login y autenticación de usuarios
- Reserva y gestión de citas (crear, editar, cancelar)
- Panel de administrador: agenda diaria y CRUD de servicios
- Compilación de SASS y minificación de assets con Gulp

---

## 🚀 Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/AngelAyal4/appsalon-phpmvc.git
cd appsalon-phpmvc

# 2. Instalar dependencias
composer install
npm install

# 3. Compilar assets
gulp
```

Apunta el `DocumentRoot` de tu servidor local a la carpeta `/public` e importa el SQL:

```bash
mysql -u root -p nombre_db < database/appsalon.sql
```

Configura tus credenciales de BD en `includes/database.php` y accede en `http://appsalon.test`.

---

## 📁 Estructura

```
├── controllers/   # Lógica de negocio
├── models/        # Interacción con la base de datos
├── views/         # Plantillas HTML/PHP
├── public/        # DocumentRoot (index.php + assets compilados)
└── src/           # SASS y JS fuente
```

---

## 🛠️ Stack

| Backend | Base de datos | Frontend | Build |
|---------|--------------|----------|-------|
| PHP 8 + MVC | MySQL 8 | HTML, SASS, JS | Gulp + Composer |

---

Desarrollado por [AngelAyal4](https://github.com/AngelAyal4)
