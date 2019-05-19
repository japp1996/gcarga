'use strict'

const Sequelize = require('sequelize');
const config = require('../config')

function connections() {
  const sequelize = new Sequelize(config.database, config.user, config.password, {
    dialect: 'mysql',
    host: config.host,
    port: config.port_db,
    logging: false,
    timezone: 'America/Caracas'
  })

  return sequelize
}

module.exports = {
  connections
}
