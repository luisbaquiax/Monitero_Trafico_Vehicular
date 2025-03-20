<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulación de Intersección</title>
    @include('utils.styles')
    <style>
        canvas {
            background-color: #2c2c2c;
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
@include('monitor.menu-monitor')
<div class="container">
    <a type="button" class="btn btn-dark mt-2" href="javascript:history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        Regresar
    </a>
    <hr>
    <canvas id="traficoCanvas" width="600" height="600"></canvas>
</div>

<script>
    const canvas = document.getElementById("traficoCanvas");
    const ctx = canvas.getContext("2d");

    let vehiculos = @json($registros);

    let semaforos = {};
    vehiculos.forEach(vehiculo => {
        semaforos[vehiculo.direccion] = vehiculo.estado_semaforo;
    });

    function dibujarSemaforo(x, y, estado) {
        ctx.fillStyle = "black";
        ctx.fillRect(x, y, 20, 50);

        ctx.fillStyle = estado === "ROJO" ? "red" : "grey";
        ctx.beginPath();
        ctx.arc(x + 10, y + 10, 5, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = estado === "AMARILLO" ? "yellow" : "grey";
        ctx.beginPath();
        ctx.arc(x + 10, y + 25, 5, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = estado === "VERDE" ? "green" : "grey";
        ctx.beginPath();
        ctx.arc(x + 10, y + 40, 5, 0, Math.PI * 2);
        ctx.fill();
    }

    function dibujarCarro(vehiculo) {
        ctx.fillStyle = vehiculo.tipo.includes("Camión") ? "blue" : "red";
        ctx.fillRect(vehiculo.x, vehiculo.y, 30, 15);
    }

    function inicializarVehiculos() {
        /*
        vehiculos = vehiculos.map(vehiculo => ({
            ...vehiculo,
            x: vehiculo.direccion === "OESTE" ? 550 : (vehiculo.direccion === "ESTE" ? 50 : 275),
            y: vehiculo.direccion === "NORTE" ? 50 : (vehiculo.direccion === "SUR" ? 550 : 275),
            velocidad: vehiculo.velocidad / 2,
        }));
        */
        vehiculos = vehiculos.map(vehiculo => ({
            ...vehiculo,
            x: vehiculo.direccion === "OESTE" ? 550 : (vehiculo.direccion === "ESTE" ? 50 : 275),
            y: vehiculo.direccion === "NORTE" ? 50 : (vehiculo.direccion === "SUR" ? 550 : 275),
            velocidad: vehiculo.velocidad / 2,
        }));
    }

    function actualizar() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Dibujar la carretera
        ctx.fillStyle = "gray";
        ctx.fillRect(0, 270, 600, 60);
        ctx.fillRect(270, 0, 60, 600);

        // Dibujar semáforos dinámicamente
        dibujarSemaforo(250, 180, semaforos["NORTE"] || "ROJO");
        dibujarSemaforo(330, 400, semaforos["SUR"] || "VERDE");
        dibujarSemaforo(180, 300, semaforos["OESTE"] || "VERDE");
        dibujarSemaforo(400, 250, semaforos["ESTE"] || "AMARILLO");

        // Mover y dibujar vehículos
        vehiculos.forEach(vehiculo => {
            if (vehiculo.direccion === "OESTE" && semaforos["OESTE"] !== "ROJO") {
                vehiculo.x -= vehiculo.velocidad/10;
            }
            if (vehiculo.direccion === "ESTE" && semaforos["ESTE"] !== "ROJO") {
                vehiculo.x += vehiculo.velocidad/10;
            }
            if (vehiculo.direccion === "NORTE" && semaforos["NORTE"] !== "ROJO") {
                vehiculo.y -= vehiculo.velocidad/10;
            }
            if (vehiculo.direccion === "SUR" && semaforos["SUR"] !== "ROJO") {
                vehiculo.y += vehiculo.velocidad/10;
            }
            dibujarCarro(vehiculo);
        });

        requestAnimationFrame(actualizar);
    }

    inicializarVehiculos();
    actualizar();
</script>
@include('utils.footer-scripts')
</body>
</html>
