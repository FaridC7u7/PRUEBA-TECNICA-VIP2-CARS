# 🚗 PRUEBA TÉCNICA - VIP2CARS

## 📌 Descripción del Proyecto

Este proyecto es una aplicación web desarrollada en **Laravel 10** que implementa un sistema de **gestión de vehículos y clientes** mediante operaciones CRUD (Crear, Leer, Actualizar y Eliminar).
Además, incluye un **modelo de base de datos relacional para encuestas anónimas**, cumpliendo con los requerimientos de la prueba proporcionada.

---

## 🧩 Módulos del Proyecto

### 1. 🧠 Modelado de Base de Datos para Encuestas Anónimas

Se ha diseñado un esquema de base de datos relacional optimizado para registrar encuestas anónimas, cumpliendo con las condiciones establecidas en el punto 1 de la evaluación.

> 🔧 El archivo SQL con el modelo se encuentra en la raíz del proyecto: `db_prueba_tecnica.sql`.

## 🖼️ Vista Previa

![Vista previa de la aplicación](https://i.imgur.com/DyaFhKb.png)

### 🗃️ Estructura

Este modelo está compuesto por tres tablas principales:

- **surveys**: Representa cada encuesta individual. Contiene campos como `title`, `description` y `created_at`.
- **questions**: Contiene todas las preguntas asociadas a una encuesta. Se vincula a la tabla `surveys` mediante la clave foránea `survey_id`.
- **answers**: Almacena las respuestas que dan los usuarios de forma anónima. Se relaciona con la tabla `questions` a través de `question_id`.

### 2. 🚘 CRUD de Vehículos y Clientes

Funcionalidades principales:

* Registro, edición y eliminación de vehículos y clientes.
* Gestión de clientes vinculados a los vehículos.
* Validaciones en el servidor para garantizar la integridad de los datos.

---

## 🖥️ Requisitos del Sistema

* **PHP** >= 8.2
* **Composer** (gestor de dependencias de PHP)
* **MySQL**
* Opcional: **XAMPP** o equivalente para ejecutar PHP y MySQL localmente

---

## ⚙️ Instalación y Puesta en Marcha

### 1. Clona el Repositorio

```bash
git clone https://github.com/FaridC7u7/PRUEBA-TECNICA-VIP2-CARS.git
cd PRUEBA-TECNICA-VIP2-CARS
```

### 2. Configura el Entorno

Copia el archivo de ejemplo `.env` y genera una clave única para la app:

```bash
copy .env.example .env
php artisan key:generate
```

Edita el archivo `.env` y configura tus credenciales de base de datos:

```
DB_DATABASE=vip2cars_db
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 3. Instala Dependencias

```bash
composer install
```

### 4. Crea la Base de Datos

* Crea una base de datos en MySQL llamada `vip2cars_db`.
* Ejecuta el script `db_prueba_tecnica.sql` para crear las tablas requeridas.

### 5. Ejecuta Seeders

Para insertar usuario para el login

```bash
php artisan db:seed --class=UserSeeder
```

## 🔐 Acceso al sistema (Demo)

- Usuario: `demo`  
- Contraseña: `1234`

### 6. Inicia el Servidor de Desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🎨 Tecnologías Utilizadas

| Tecnología  | Descripción                           |
| ----------- | ------------------------------------- |
| Laravel 10  | Framework PHP MVC principal           |
| Blade       | Motor de plantillas del frontend      |
| Bootstrap 4 | Estilos y diseño responsivo           |
| jQuery      | Interacción dinámica con el DOM       |
| Fetch API   | Comunicación asíncrona con el backend |
| MySQL       | Base de datos relacional              |

---

## ✅ Estado Actual

* [x] CRUD de Clientes
* [x] CRUD de Vehículos
* [x] Modelado SQL para encuestas
* [x] Validación de datos en frontend y backend
* [x] Interfaz responsiva y funcional

---
