# carbon_footprint.py
# Servicio para calcular la huella de carbono (equivalente a CarbonFootprintService.php)

class CarbonFootprintService:
    def __init__(self):
        self.factors = {
            'transport': {
                'walk': 0,
                'bike': 1,
                'bus': 0.06,  # por km
                'car_shared': 0.10,
                'car_solo': 0.20
            },
            'electricity': 0.30,  # por kWh
            'lab_pc': {
                'off': 0,
                'sleep': 0.05,
                'on': 0.10
            },
            'food': {
                'vegetarian': 1.0,
                'white_meat': 3.0,
                'red_meat': 5.0
            },
            'waste': {
                'compost': 0,
                'separated': 5,
                'mixed': 10
            }
        }

    def calculate(self, data):
        total = 0
        # Transporte
        if 'transport_mode' in data and 'transport_distance' in data:
            mode = data['transport_mode']
            distance = float(data['transport_distance'])
            total += distance * self.factors['transport'].get(mode, 0)
        # Electricidad
        if 'electricity_use' in data:
            total += float(data['electricity_use']) * self.factors['electricity']
        # Computadora laboratorio
        if 'lab_pc_usage_hours' in data and 'lab_pc_behavior' in data:
            hours = float(data['lab_pc_usage_hours'])
            behavior = data['lab_pc_behavior']
            total += hours * self.factors['lab_pc'].get(behavior, 0)
        # Comida
        if 'meals_red_meat' in data:
            total += int(data['meals_red_meat']) * self.factors['food']['red_meat']
        if 'meals_white_meat' in data:
            total += int(data['meals_white_meat']) * self.factors['food']['white_meat']
        if 'meals_vegetarian' in data:
            total += int(data['meals_vegetarian']) * self.factors['food']['vegetarian']
        # Residuos
        if 'waste_management' in data:
            total += self.factors['waste'].get(data['waste_management'], 0)
        return total
