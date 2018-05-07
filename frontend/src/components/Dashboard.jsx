import React from 'react';
import Panel from './Panel.jsx'
import styles from '../assets/sass/dashboard.scss';

import List from './List.jsx'

export default class Dashboard extends React.Component {
  render() {
    return (
     <div className='container'>
        <h1>Hello World</h1>
        <p> Welcome to Journeo</p>
        <Panel title={'Suitcase'}>
          <List />
        </Panel>
        <Panel title={'Paper copies'}>
          <List />
        </Panel>
        <Panel />
      </div>
    );
  }
}