import express from 'express';
import Usuario from '/Users/nataliacastellfranco/Desktop/ncastell_projecte/enxarxa/api/models/Usuario'; // Ajusta la ruta según la ubicación real de Usuario.js
const app = express();
const port = 3000;

app.use(express.json());

// Ruta para obtener los usuarios
app.get('/api/usuarios', async (req, res) => {
  try {
    const usuarios = await Usuario.findAll(); // Utiliza el modelo Usuario para obtener los usuarios desde la base de datos

    res.json(usuarios);
  } catch (error) {
    console.error('Error al obtener los usuarios:', error);
    res.status(500).json({ error: 'Error al obtener los usuarios' });
  }
});

app.listen(port, () => {
  console.log(`Servidor API escuchando en http://localhost:${port}`);
});
