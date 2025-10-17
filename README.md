
# 🧾 Sistema Contable Integral de Gestión y Optimización Pública (SciGOP)

> Proyecto académico desarrollado bajo el enfoque **PMP** y el patrón **MVC (Model-View-Controller)** para la sistematización de procesos contables, financieros, de nómina e inventario.

---

## 📘 Descripción General

**SciGOP** es una aplicación web modular desarrollada en **Laravel (PHP)** con base de datos en **MySQL**, desplegable en **Azure** mediante **Docker**. Su objetivo es automatizar procesos administrativos y contables, mejorar la trazabilidad de la información y facilitar la generación de reportes financieros.

---

## 👥 Equipo de Desarrollo

| Rol | Integrante |
|------|-------------|
| Gerente del Proyecto / Full-Stack Dev | **Nicolás López Sánchez** |
| Full-Stack Dev | **Daniel Alejandro Albarracín Vargas** |
| Full-Stack Dev | **Juan Sebastián Garzón Gómez** |
| Full-Stack Dev | **Lina Mariana Pinzón Pinzón** |

---

## ⚙️ Tecnologías y Herramientas

- **Framework:** Laravel (PHP)  
- **Base de Datos:** MySQL  
- **Contenerización:** Docker / docker-compose  
- **Despliegue:** Azure (Web App / Containers)  
- **Control de Versiones:** Git / GitHub  
- **Frontend:** Blade Templates + Bootstrap  
- **ORM:** Eloquent  
- **Autenticación:** Laravel Auth (roles: Administrador, Cajero, Contador)  
- **Reportes:** Exportación a PDF (por ejemplo dompdf o equivalente)

---

## 🧩 Módulos Principales

- **Gestión de Usuarios y Roles** — Alta, edición, autenticación y permisos por rol.  
- **Inventario** — CRUD de productos, control de stock y alertas por stock mínimo.  
- **Compras y Proveedores** — Registro de proveedores, órdenes y facturas de compra.  
- **Ventas y Facturación** — Procesamiento de ventas, generación de facturas y ajuste de inventario.  
- **Contabilidad y Finanzas** — Integración de movimientos para reportes contables.  
- **Nómina** — Cálculo y registro de pagos, deducciones e impuestos.  
- **Reportes** — Reportes de ventas, inventario y nómina con exportación a PDF.  
- **Configuración del Sistema** — Parámetros generales (empresa, impuestos, moneda, etc.).

---

## 🔄 Flujo de Uso (resumen práctico)

1. **Inicio de sesión** → autenticación y redirección según rol.  
2. **Administrar inventario** → crear/editar productos y niveles de stock.  
3. **Registrar compras** → almacenar ordenes y facturas de proveedores.  
4. **Procesar ventas** → registrar venta, generar factura y descontar stock.  
5. **Generar reportes** → consolidar y exportar datos en PDF.  
6. **Administrar nómina** → calcular y registrar pagos periódicos.  
7. **Ajustes** → modificar configuraciones globales del sistema.

---

## 🧠 Arquitectura y Flujo de Datos Interno

Patrón MVC típico de Laravel:

```

[Cliente] → [Rutas (routes/web.php)] → [Controlador] → [Modelo (Eloquent)] → [Base de datos]
↓
[Vistas Blade]

```

Ejemplo de flujo (venta):
- Usuario envía formulario de venta → ruta `/ventas/store` → `VentaController@store` → valida datos → crea `Venta` y `DetalleVenta` → `Producto::decrement('stock', cantidad)` → genera PDF de factura y respuesta al cliente.

---

## 🗂️ Estructura General del Repositorio

```

PGCGestionDatos/
│
├── app/
│   ├── Http/Controllers/        # Controladores (Auth, Inventario, Ventas, Compras, Reportes, Nomina, Config)
│   ├── Models/                  # Modelos Eloquent (User, Producto, Venta, Compra, Nomina, Proveedor)
│   └── ...
│
├── database/
│   ├── migrations/              # Migraciones MySQL
│   └── seeders/                 # Seeders con datos iniciales
│
├── resources/
│   ├── views/                   # Blade templates
│   ├── js/
│   └── css/
│
├── routes/
│   └── web.php
│
├── docker-compose.yml
├── .env.example
├── composer.json
└── README.md

````

---

## 🚀 Instalación y Ejecución Local

### Requisitos Previos
- PHP ≥ 8.1  
- Composer  
- MySQL ≥ 8.0  
- Docker (opcional)

### Pasos rápidos

```bash
# Clonar repositorio
git clone https://github.com/lopezns/SciGOP.git
cd SciGOP

# Dependencias PHP
composer install

# Variables de entorno
cp .env.example .env
php artisan key:generate
# Configurar .env con credenciales de DB

# Migraciones y seeders
php artisan migrate --seed

# Ejecutar en local
php artisan serve
# Acceder en http://127.0.0.1:8000
````

### Ejecutar con Docker

```bash
docker-compose up -d
# Revisar logs y servicios (DB, app, etc.)
```

---

## ✅ Pruebas

Ejecutar pruebas unitarias e integración básicas:

```bash
php artisan test
```

Criterios sugeridos de aceptación:

* Generación correcta de reportes PDF.
* Funcionalidad de ventas y ajuste de inventario.
* Autenticación y control por roles funcionando.

---

## 🔐 Seguridad y Buenas Prácticas

* No almacenar claves en texto plano: usar `.env`.
* Validaciones server-side en controladores y reglas de Request.
* Uso de prepared statements y Eloquent para evitar inyección SQL.
* Control de acceso por middleware y roles.
* Contenerizar para entornos reproducibles.

---

## 📦 Despliegue

* Construir imagen Docker y desplegar en Azure Web App for Containers o en un servicio de contenedores.
* Configurar variables de entorno en el servicio de despliegue.
* Ejecutar migraciones en entorno de producción con respaldo previo.

---

## 🔧 Mantenimiento y Contribución

1. Crear una rama feature/xxx para desarrollos.
2. Hacer PR hacia `develop` con descripción y pruebas.
3. Revisar y aprobar antes de merge a `main`.
4. Actualizar documentación y migraciones si aplica.

---

## 🧾 Licencia

Proyecto académico — uso y reproducción con fines educativos y citando autores.

---

## 💬 Contacto

**Nicolás López Sánchez** — Gerente del Proyecto
GitHub: [https://github.com/lopezns](https://github.com/lopezns)


