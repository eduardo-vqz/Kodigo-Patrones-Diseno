# 📘 Patrones de Diseño en PHP  
### Ejercicios prácticos aplicando Factory, Adapter, Decorator y Strategy  
**Materia:** Desarrollo de Aplicaciones  
**Actividad:** Guía de ejercicios – Patrones de Diseño  

---

## Descripción del proyecto

Este repositorio contiene el desarrollo de **cuatro ejercicios prácticos** aplicando patrones de diseño en PHP.  
El objetivo es demostrar el uso correcto de **Factory**, **Adapter**, **Decorator** y **Strategy** mediante programas funcionales organizados, acompañados de interfaces web diseñadas con **Bootstrap**.

Cada ejercicio incluye:

- Código orientado a objetos (POO).
- Implementación explícita del patrón solicitado.
- Carpeta `public/` con la interfaz gráfica.
- Estructura modular y clara.
- Uso de `require_once`.

---

## Ejercicios desarrollados

### ✔ **Ejercicio 1 – Patrón Factory**
Crea personajes de videojuego según el nivel:

- Nivel fácil → **Esqueleto**  
- Nivel difícil → **Zombi**  

Usa el patrón **Factory** para decidir qué personaje debe instanciarse.

Carpeta: `ejercicio1_factory/`

---

### ✔ **Ejercicio 2 – Patrón Adapter**
Simula compatibilidad entre archivos creados en:

- Windows 7 (formato antiguo)
- Windows 10 (formato moderno)

Windows 10 no puede abrir archivos Win7 directamente; por ello se utiliza un **Adapter** para traducir las llamadas del sistema antiguo al nuevo.

Carpeta: `ejercicio2_adapter/`

---

### ✔ **Ejercicio 3 – Patrón Decorator**
Permite añadir **armas** (espada, arco, escudo…) a personajes como:

- Guerrero  
- Mago  

Cada arma modifica dinámicamente el comportamiento del personaje mediante el patrón **Decorator**.

Carpeta: `ejercicio3_decorator/`

---

### ✔ **Ejercicio 4 – Patrón Strategy**
Permite mostrar mensajes mediante tres estrategias distintas:

- Salida por consola  
- Salida en JSON  
- Salida en archivo TXT  

El patrón **Strategy** permite intercambiar dinámicamente la forma de salida del mensaje.

Carpeta: `ejercicio4_strategy/`

---

## 📁 Estructura general del repositorio

```text
/
├── ejercicio1_factory/
│   ├── src/
│   └── public/
│
├── ejercicio2_adapter/
│   ├── src/
│   └── public/
│
├── ejercicio3_decorator/
│   ├── src/
│   └── public/
│
├── ejercicio4_strategy/
│   ├── src/
│   └── public/
│
└── README.md
