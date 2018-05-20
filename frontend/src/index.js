/*
    ./src/index.js
    which is the webpack entry file
*/

import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App.jsx';
import styles from './assets/sass/app.scss';

import axios from 'axios';

axios.defaults.baseURL = 'http://journeo.api.ugobouveron.com';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';


ReactDOM.render(<App />, document.getElementById('root'));