'use strict'

const app = require('./app')
const config = require('./config')
const server = app.server

server.listen(config.port)
