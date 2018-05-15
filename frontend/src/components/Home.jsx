import React from 'react';
import Panel from './Panel.jsx'
import CreateJourney from './CreateJourney.jsx'

export default class Home extends React.Component {
  render() {
    return (
     <div>
        <h1>Hello World</h1>
        <p> Welcome to Journeo</p>
        <Panel title={'Nouveau voyage'}>   
            <CreateJourney checkUpdate={this.props.changeRefresh}/>
        </Panel>
      </div>
    );
  }
}