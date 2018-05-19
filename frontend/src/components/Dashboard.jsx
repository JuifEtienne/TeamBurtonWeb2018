import React from 'react';
import Panel from './Panel.jsx'
import styles from '../assets/sass/dashboard.scss';

import List from './List.jsx'
import Paper from './Paper.jsx'
import Luggage from './Luggage.jsx'
import Weather from './Weather.jsx'
import Destination from './Destination.jsx'

export default class Dashboard extends React.Component {
    
  render() {
    return (
        <div>
        <Destination idPage={this.props.idPage}/>
        <div className='panel-container'>
         <div className='container'>


            <article className=''>
            <Panel title={'Suitcase'}>
              <Luggage idPage={this.props.idPage}/>
            </Panel>
            </article>

             <article className=''>
            <Panel title={'Paper copies'}>
              <Paper idPage={this.props.idPage} type={'paper'} />
            </Panel>
            </article>

            <Panel title={'Weather'}>
              <Weather />
            </Panel>

          </div>
            </div>
        </div>
    );
  }
}