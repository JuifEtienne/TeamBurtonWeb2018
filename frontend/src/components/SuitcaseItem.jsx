import React from 'react';

export default class SuitcaseItem extends React.Component {
  constructor(props){
      super(props)
      this.state = props.state;
  }

  onChekChange(){
    this.setState(prevState => ({checked: !prevState.checked}));
  }

  render() {
    return (

     <li className='suitcaseItem'>
      <p>
        {this.state.name}
        <span>{this.state.number}</span>
        <button onClick={() => this.onChekChange()} >{this.state.checked ? 'v' : '!'}</button>
        <button>X</button> </p>
    </li>

    );
  }
}