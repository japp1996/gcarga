'use strict'

const express = require('express')
const bodyParser = require('body-parser')
const socket = require('./socket/socket')
const app = socket.app
const server = socket.server
const api = require('./routes/web')
const io = socket.io

app.use(bodyParser.urlencoded({ extended: false }))
app.use(bodyParser.json())
app.use('/', api)

module.exports = {
  app,
  server
}
