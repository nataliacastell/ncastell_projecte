const { Sequelize, DataTypes } = require('sequelize');
const sequelize = new Sequelize('enxarxa', 'root', ' ', {
  host: 'localhost',
  dialect: 'mysql',
});

const Usuario = sequelize.define('Usuario', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  nombre: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  correo_electronico: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  contrasena: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  tipo_usuario: {
    type: DataTypes.ENUM('Admin', 'Standard'),
    defaultValue: 'Standard',
  },
});

// Método para obtener todos los usuarios
Usuario.obtenerUsuarios = async () => {
  try {
    const usuarios = await Usuario.findAll();
    return usuarios;
  } catch (error) {
    console.error('Error al obtener los usuarios:', error);
    throw error;
  }
};

// ...

module.exports = Usuario;
