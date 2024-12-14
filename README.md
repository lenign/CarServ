# CarServ Doc

# Comando para levantar proyecto con PHP 
php -S localhost:7000 -t public

# Levantar imagen de docker 
docker-compose up --build -d

# Detener contenedor de docker
docker-compose down

# Iniciar imagen
docker start web_server  

# Rollback a ultimo commit
git reset HEAD^ --hard
git push origin -f

# Traer la rama despues de cualquier conflicto
git reset --hard origin/name-branch

# Conexion con mysql alojada en la imagen de docker
docker exec -it mysql_db mysql -u root -p

# Comprobar el estado de servicios
sudo systemctl status mysql
service apache2 status

# Revisar los registros de mi imagen
docker logs web_server

netstat -tlnp | grep mysql
mysql -u root -p 

mysql -h 127.0.0.1 -P 3306 -u root -p'rootpassword'  TiendaVirtual
docker exec -it web_server bash

# Scripts de la base de datos 

-- Active: 1733537689345@@127.0.0.1@3306
CREATE DATABASE carserv
    DEFAULT CHARACTER SET = 'utf8mb4';

-- database/tuningcar.sql

CREATE DATABASE carserv;

USE carserv;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(15),
    direccion TEXT
);

CREATE TABLE ServiciosRevision (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

CREATE TABLE ServiciosReparacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100)
);

CREATE TABLE Citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    servicio_id INT,
    tipo_servicio ENUM('revision', 'reparacion') NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (servicio_id) REFERENCES ServiciosReparacion(id)
);

CREATE TABLE OrdenTrabajo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cita_id INT,
    tecnico_id INT,
    descripcion TEXT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado ENUM('en_proceso', 'completada') DEFAULT 'en_proceso',
    FOREIGN KEY (cita_id) REFERENCES Citas(id),
    FOREIGN KEY (tecnico_id) REFERENCES Tecnicos(id)
);

CREATE TABLE Factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orden_trabajo_id INT,
    fecha DATE NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (orden_trabajo_id) REFERENCES OrdenTrabajo(id)
);

CREATE TABLE TarjetasCredito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    numero_tarjeta VARCHAR(16) NOT NULL,
    nombre_titular VARCHAR(100) NOT NULL,
    fecha_expiracion DATE NOT NULL,
    cvv VARCHAR(4) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);

CREATE TABLE Pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    factura_id INT,
    tarjeta_credito_id INT,
    fecha DATE NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (factura_id) REFERENCES Factura(id),
    FOREIGN KEY (tarjeta_credito_id) REFERENCES TarjetasCredito(id)
);


# datos de prueba para la base de datos

-- Usuarios
INSERT INTO Usuarios (nombre, email, password, telefono, direccion) VALUES
('Juan Perez', 'juan.perez@example.com', 'password123', '555-1234', 'Calle Falsa 123'),
('Maria Lopez', 'maria.lopez@example.com', 'password456', '555-5678', 'Avenida Siempre Viva 456');

-- ServiciosRevision
INSERT INTO ServiciosRevision (nombre, descripcion, precio) VALUES
('Cambio de Aceite', 'Cambio de aceite y filtro', 29.99),
('Revisión de Frenos', 'Inspección y ajuste de frenos', 49.99);

-- ServiciosReparacion
INSERT INTO ServiciosReparacion (nombre, descripcion, precio) VALUES
('Reparación de Motor', 'Reparación completa del motor', 499.99),
('Cambio de Transmisión', 'Cambio de transmisión automática', 799.99);

-- Tecnicos
INSERT INTO Tecnicos (nombre, especialidad) VALUES
('Carlos Sanchez', 'Motores'),
('Ana Martinez', 'Transmisiones');

-- Citas
INSERT INTO Citas (usuario_id, servicio_id, tipo_servicio, fecha, hora, estado) VALUES
(1, 1, 'revision', '2023-10-01', '10:00:00', 'pendiente'),
(2, 2, 'reparacion', '2023-10-02', '11:00:00', 'confirmada');

-- OrdenTrabajo
INSERT INTO OrdenTrabajo (cita_id, tecnico_id, descripcion, fecha_inicio, fecha_fin, estado) VALUES
(1, 1, 'Cambio de aceite y filtro', '2023-10-01', '2023-10-01', 'completada'),
(2, 2, 'Reparación completa del motor', '2023-10-02', '2023-10-05', 'en_proceso');

-- Factura
INSERT INTO Factura (orden_trabajo_id, fecha, total) VALUES
(1, '2023-10-01', 29.99),
(2, '2023-10-05', 499.99);

-- TarjetasCredito
INSERT INTO TarjetasCredito (usuario_id, numero_tarjeta, nombre_titular, fecha_expiracion, cvv) VALUES
(1, '1234567812345678', 'Juan Perez', '2025-12-31', '123'),
(2, '8765432187654321', 'Maria Lopez', '2024-11-30', '456');

-- Pagos
INSERT INTO Pagos (factura_id, tarjeta_credito_id, fecha, monto) VALUES
(1, 1, '2023-10-01', 29.99),
(2, 2, '2023-10-05', 499.99);
