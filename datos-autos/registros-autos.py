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

estado_semaforo = ["AMARILLO", "VERDE"]

# Cantidad de registros a generar
num_registros = 100
hora_inicio =  "07:00:00"
hora_finalizacion = "09:00:00"
id_registro_archivo = 1

# Estructura principal del JSON
datos = {
        "fecha": "2025-03-16",
        "hora_inicio": hora_inicio,
        "hora_finalizacion": hora_finalizacion,
        "tipo": "JSON",
        "registros": []
}

# Generar datos de vehículos
for i in range(num_registros):
    registro = {
        "id_tipo_vehiculo": random.randint(1, 20),
        "velocidad": round(random.uniform(10, 80), 1),
        "hora": hora_aleatoria(hora_inicio, hora_finalizacion),
        "estado_semaforo": random.choice(estado_semaforo),
        "id_sensor": random.randint(1, 4)
    }
    datos["registros"].append(registro)

# Guardar en archivo JSON
with open("datos Intersección 3ra Calle y 6ta Calle.json", "w", encoding="utf-8") as archivo:
    json.dump(datos, archivo, indent=2, ensure_ascii=False)

print("✅ Archivo 'datos.json' generado con éxito.")
