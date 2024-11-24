-- Crear la base de datos
CREATE DATABASE reforesta;
use reforesta;
-- Crear la tabla de Usuarios
CREATE TABLE Usuarios(
    Nickname VARCHAR(250) PRIMARY KEY,
    Nombre VARCHAR(150) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Email VARCHAR(500) UNIQUE NOT NULL,
    Karma INT DEFAULT 0,
    Suscrito BOOLEAN DEFAULT FALSE,
    FechaCreacion VARCHAR(255)
);

-- Crear la tabla de Especies
CREATE TABLE Especies (
    NombreCientifico VARCHAR(100) NOT NULL PRIMARY KEY,
    Beneficios VARCHAR(255),
    NombreComun VARCHAR(200) NOT NULL,
    Descripcion TEXT NOT NULL,
    Clima VARCHAR(200) NOT NULL,
    RegionOrigen VARCHAR(100) NOT NULL,
    TiempoMaduracion INT NOT NULL,
    ImagenURL VARCHAR(555) NOT NULL
);

-- Crear la tabla de Eventos
CREATE TABLE Eventos (
    EventoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT NOT NULL,
    Provincia VARCHAR(250) NOT NULL,
    Localidad VARCHAR(200) NOT NULL,
    TipoTerreno VARCHAR(250) NOT NULL,
    TipoEvento VARCHAR(250) NOT NULL,
    Fecha VARCHAR(255),
    AnfitrionID VARCHAR(250) NOT NULL,
    Estado VARCHAR(250) DEFAULT 'Pendiente',
    FechaAprobacion VARCHAR(255),
    FechaCreacion VARCHAR(255) ,
    ImagenURL VARCHAR(555) NOT NULL DEFAULT 'https://example.com/default-event-image.jpg',
    CONSTRAINT fk_Anfitrion FOREIGN KEY (AnfitrionID) REFERENCES Usuarios(Nickname) ON DELETE CASCADE
);


-- Crear la tabla de Participantes
CREATE TABLE Participantes (
    UserID VARCHAR(250) NOT NULL,
    EventoID INT NOT NULL,
    PRIMARY KEY (UserID, EventoID),
    CONSTRAINT fk_userpar FOREIGN KEY (UserID) REFERENCES Usuarios(Nickname) ON DELETE CASCADE,
    CONSTRAINT fk_eventopar FOREIGN KEY (EventoID) REFERENCES Eventos(EventoID) ON DELETE CASCADE
);

-- Crear tablas de eventos especies
CREATE TABLE EventosEspecies (
    EventoID INT NOT NULL,
    EspecieID VARCHAR(100) NOT NULL,
    Cantidad INT NOT NULL,
    PRIMARY KEY (EventoID, EspecieID),
    CONSTRAINT fk_evetntospe FOREIGN KEY (EventoID) REFERENCES Eventos(EventoID) ON DELETE CASCADE,
    CONSTRAINT fk_specioevento FOREIGN KEY (EspecieID) REFERENCES Especies(NombreCientifico) ON DELETE CASCADE
);

-- creame los insert
--insert de un Usuarios
INSERT INTO Usuarios (Nickname, Nombre, Apellidos, Email, Karma, Suscrito)
VALUES 
('Juan23', 'Juan', 'Pérez López', 'juan23@example.com', 10, FALSE);
('Maria88', 'María', 'Gómez Martínez', 'maria88@example.com', 20, FALSE);




update Usuarios set Nickname='Juan23' where Nickname='Juan23';

INSERT INTO Eventos (Nombre, Descripcion, Provincia, Localidad, TipoTerreno, TipoEvento, Fecha, AnfitriónID)
VALUES 
('Reforestación de Primavera', 'Plantación de árboles jóvenes en zona erosionada.', 'Madrid', 'Alcalá de Henares', 'Erosionado', 'Reforestación con Árboles Jóvenes', '2024-03-15 10:00:00', 'Juan23'),
('Recogida de Semillas en Otoño', 'Recolecta de semillas de árboles autóctonos.', 'Barcelona', 'Montcada i Reixac', 'Colina', 'Recogida de Semillas', '2024-11-25 09:00:00', 'Maria88');

INSERT INTO Eventos (Nombre, Descripcion, Provincia, Localidad, TipoTerreno, TipoEvento, Fecha, 
                     AnfitrionID, Estado, FechaAprobacion, ImagenURL) 
VALUES ('Reforestación de la Colina Norte', 
        'Actividad para recuperar zonas erosionadas con árboles autóctonos.', 
        'Barcelona', 
        'Montcada i Reixac', 
        'Colina', 
        'Reforestación con Árboles Jóvenes', 
        '2024-01-15', 
        'Juan23', 
        'Pendiente', 
        NULL, 
        'https://example.com/images/evento-reforestacion.jpg');
