import json
import random
from datetime import datetime, timedelta

# Función para generar una hora aleatoria dentro de un rango
def hora_aleatoria(hora_inicio, hora_fin):
    formato = "%H:%M:%S"
    inicio = datetime.strptime(hora_inicio, formato)
    fin = datetime.strptime(hora_fin, formato)
    diferencia = fin - inicio
    segundos_aleatorios = random.randint(0, int(diferencia.total_seconds()))
    return (inicio + timedelta(seconds=segundos_aleatorios)).strftime(formato)

# Tipos de vehículos
tipo_vehiculo = [
    "Automóvil",
    "Motocicleta",
    "Camión",
    "Autobús",
    "Bicicleta",
    "Furgoneta",
    "Camioneta",
    "Taxi",
    "Motocarro",
    "Tractocamión",
    "Minivan",
    "Ciclomotor",
    "Carro de carga",
    "Camión de reparto",
    "Auto deportivo",
    "SUV",
    "Van de pasajeros",
    "Pick-up",
    "Camión cisterna",
    "Carro de policía"
]

estado_semaforo = ["AMARILLO", "VERDE"]

# Cantidad de registros a generar
num_registros = 100
hora_inicio =  "07:00:00"
hora_finalizacion = "09:00:00"
id_registro_archivo = 1

# Estructura principal del JSON
datos = {
    "archivo_registro": {
        "fecha": "2025-03-16",
        "hora_inicio": hora_inicio,
        "hora_finalizacion": hora_finalizacion,
        "tipo": "JSON",
        "registros": []
    }
}

# Generar datos de vehículos
for i in range(num_registros):
    registro = {
        "id_tipo_vehiculo": random.randint(1, 20),
        "velocidad": round(random.uniform(10, 80), 1),  # Velocidad entre 10 y 120 km/h
        "hora": hora_aleatoria(hora_inicio, hora_finalizacion),
        "estado_semaforo": random.choice(estado_semaforo),
        "id_sensor": random.randint(1, 4)  # Sensores del 1 al 10
    }
    datos["archivo_registro"]["registros"].append(registro)

# Guardar en archivo JSON
with open("datos.json", "w", encoding="utf-8") as archivo:
    json.dump(datos, archivo, indent=2, ensure_ascii=False)

print("✅ Archivo 'datos.json' generado con éxito.")
