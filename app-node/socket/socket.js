'use strict'

const express = require('express')
const app = express()
const server = require('http').Server(app)
const io = require('socket.io')(server)
const userCtrl = require('../controllers/UserController')

var users_connected = []

io.on('connection', (socket) => {
    console.log(`>>> socket conectada: ${socket.id}`)
    users_connected = userCtrl.addUserSocket(socket.id, users_connected)

    // Actualizar la posicion de los usuarios
    socket.on('sendPosition', (pos) => {
        userCtrl.findById(pos.user_id, users_connected, (response) => {
            // if (response != null && response != undefined) {
            //     if (socket.id != response.socketId) {
            //         io.sockets.connected[response.socketId].disconnect()             
            //         users_connected = userCtrl.deleteByUserId(pos.user_id, users_connected)
            //     }
            // }
            users_connected = userCtrl.setLocationSocket(socket.id, pos, users_connected)
            // console.log(users_connected);            
        })
        userCtrl.setLocation(pos, (data) => {
            io.emit('getPosition', pos)
        })
    })

    // El usuario cerro sesion
    socket.on('disconnecting', (data) => {
        userCtrl.findBySocket(socket.id, users_connected, (resp) => {
            users_connected = userCtrl.deleteBySocket(socket.id, users_connected)
        })
    })

    // La socket se desconecto
    socket.on('disconnect', () => {
        // console.log(`>>> socket desconectada: ${socket.id}`)
        userCtrl.findBySocket(socket.id, users_connected, (resp) => {
            users_connected = userCtrl.deleteBySocket(socket.id, users_connected)
        })
    })
})  


module.exports = {
    server,
    io,
    app
}
