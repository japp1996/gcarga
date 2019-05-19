'use strict'

const User = require('../models/User')

function setLocation(req, fn) {    
    if (req.latitude != null && req.longitude != null && req.user_id !== null) {
        User.update({
            latitude: req.latitude,
            longitude: req.longitude
        }, {
            where: {
                id: req.user_id
            }
        }).then(resp => {
            fn(resp)
        })
    }
}

function addUserSocket(socketId, users_online) {
    if (users_online.length > 0) {
        let find = users_online.find((el) => {
            return (el.socketId == socketId)
        })
        if (find == undefined || find == null) {
            users_online.push({
                socketId: socketId
            })
        }
    } else {
        users_online.push({
            socketId: socketId
        })
    }

    return users_online
}

function setLocationSocket(socketId, data, users_online) {
    if (users_online.length > 0) {
        let find = users_online.find((el) => {
            return (el.socketId == socketId)
        })
        if (find == undefined || find == null) {
            users_online.push({
                socketId: socketId
            })
        }
        for (let index = 0; index < users_online.length; index++) {
            if (users_online[index].socketId === socketId) {
                users_online[index].userId = data.user_id
                users_online[index].latitude = data.latitude
                users_online[index].longitude = data.longitude
            }
        }
    }
    return users_online
}

function findBySocket(socketId, users_online, callback) {
    let field = null
    if (users_online.length > 0) {
        field = users_online.find((el) => {
            return (el.socketId == socketId)
        })
    }
    callback(field)
}

function findById(userId, users_online, callback) {
    let field = null
    if (users_online.length > 0) {
        field = users_online.find((el) => {
            return (el.userId == userId)
        })
    }
    callback(field)
}

function deleteBySocket(socketId, users_online) {
    let online = new Array()
    if (users_online.length > 0) {
        online = users_online.filter((el) => {
            return (el.socketId != socketId)
        })
    }
    return online
}

module.exports = {
    setLocation,
    addUserSocket,
    setLocationSocket,
    findBySocket,
    deleteBySocket,
    findById
}
