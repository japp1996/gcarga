'use strict'

const Sequelize = require('sequelize')
const sequelize = require('../core/conection')

const User = sequelize.connections().define('users', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: Sequelize.STRING(191),
    email: Sequelize.STRING(191),
    latitude: Sequelize.STRING(191),
    longitude: Sequelize.STRING(191),
    avatar: Sequelize.STRING(191)
}, {
    createdAt: 'created_at',
    updatedAt: 'updated_at',
})

module.exports = User
