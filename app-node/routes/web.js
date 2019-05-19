'use strict'

const express = require('express')
const config = require('../config')
const api = express.Router()

api.get('/', (req, res) => {
	res.redirect(config.base_url)
})

module.exports = api