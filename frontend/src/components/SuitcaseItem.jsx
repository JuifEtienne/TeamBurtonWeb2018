import React from 'react';

export default class SuitcaseItem extends React.Component {
  render() {
    const {name, number} = this.props

    return (
     <li className='suitcaseItem'>
      <p>{name} <span>{number}</span> </p>
    </li>
    );
  }
}