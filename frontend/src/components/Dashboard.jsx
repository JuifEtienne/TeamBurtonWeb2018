import React from 'react';
import Panel from './Panel.jsx'

export default class Dashboard extends React.Component {
  render() {
    return (
     <div>
        <h1>Hello World</h1>
        <p> Welcome to Journeo</p>
        <Panel />
        <Panel />
      </div>
    );
  }
}