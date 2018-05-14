import React from 'react';
import styles from '../assets/sass/panel.scss'

export default class Panel extends React.Component {
  render() {
    const {children, title} = this.props

    return (
     <div className='panel'>
      <div className='panelHeader'>
        <div className='control'>
          <div className='symbols'></div>
        </div>
        <h2>{title}</h2>
      </div>
        <div className='gradient'></div>

      <div className='panelContent'>
        {children}
      </div>
    </div>
    );
  }
}