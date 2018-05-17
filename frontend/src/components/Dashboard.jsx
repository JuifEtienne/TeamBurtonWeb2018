import React from 'react';
import Panel from './Panel.jsx'
import styles from '../assets/sass/dashboard.scss';

import List from './List.jsx'
import Luggage from './Luggage.jsx'
import Weather from './Weather.jsx'

export default class Dashboard extends React.Component {
    
  render() {
    return (
     <div className='container'>
        <h1>Hello World</h1>
        <p> Welcome to Journeo</p>

        <Panel title={'Suitcase'}>
          <Luggage idPage={this.props.idPage}/>
        </Panel>

        <Panel title={'Paper copies'}>
          <List idPage={this.props.idPage} type={'paper'} />
        </Panel>

        <Panel title={'Weather'}>
          <Weather />
        </Panel>
      </div>
    );
  }
}