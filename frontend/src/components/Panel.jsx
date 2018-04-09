import React from 'react';
import styles from '../assets/sass/panel.scss'

export default class Panel extends React.Component {
  render() {
    return (
     <div className='panel'>
        <div className='control'>
            <div className='symbols'></div>
        </div>
        <p>Text inside a panel leeel Text inside a panel leeel Text inside a panel leeel Text inside a panel leeel Text inside a panel leeel</p>
      </div>
    );
  }
}