from flask import Flask, jsonify, request
from carbon_footprint import CarbonFootprintService

app = Flask(__name__)


# Endpoint para prueba
@app.route('/')
def home():
    return jsonify({"message": "API Huella de Carbono Flask funcionando"})

# Endpoint para recibir datos del formulario de huella de carbono
@app.route('/api/huella', methods=['POST'])
def calcular_huella():
    data = request.json
    service = CarbonFootprintService()
    total = service.calculate(data)
    return jsonify({
        "status": "ok",
        "huella_carbono": total,
        "datos_recibidos": data
    })

if __name__ == '__main__':
    app.run(debug=True)
