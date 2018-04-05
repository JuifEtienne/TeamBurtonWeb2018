import React from 'react';
import Menu from './Menu.jsx';
import Dashboard from './Dashboard.jsx'
import styles from '../assets/sass/app.scss';


export default class App extends React.Component {
  render() {
    return (
     <div>
        <div id='menu'>    
            <Menu />
        </div>
        <div id='dashboard'>
            <Dashboard />
        </div>
      </div>);
  }
}