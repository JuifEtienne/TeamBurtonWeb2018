import React from 'react';
import SuitcaseItem from './SuitcaseItem.jsx'

export default class Suitcase extends React.Component {
	constructor(props){
        super(props)
        this.state = {
        	currentNum: 0,
        	currentName: "",
            suitcase: [
            	{name:"pantalon", number:3, checked:true},
            	{name:"t-shirt", number:5, checked:false}
            ]
        };
    }

    addToSuitcase(event){
    	event.preventDefault();

    	var tempObj = {name: this.state.currentName, number: this.state.currentNum}

		this.setState({suitcase: [...this.state.suitcase, tempObj] });

		this.state.currentNum = 0;
		this.state.currentName = "";
	}

	decreaseNum(){
		this.setState(prevState => ({currentNum: prevState.currentNum-1}));

	}

	increaseNum(){
		this.setState(prevState => ({currentNum: prevState.currentNum+1}));
		
	}

	setCurrentName(event){
		this.setState({currentName: event.target.value});
	}

  render() {
    return (
     <div>
     	<form className="suitcase" onSubmit={(e) => this.addToSuitcase(e)} >
	        <input type="text" name="name" value={this.state.currentName} onChange={(e) => this.setCurrentName(e)}/>

	        <input type="button" value="-" name="less" onClick={() => this.decreaseNum()}  disabled={this.state.currentNum == 0 ? 'disabled' : null}/>
	        <span>{this.state.currentNum}</span>
	        <input type="button" value="+" name="more" onClick={() => this.increaseNum()} />

	        <input type="submit" value="+" disabled={this.state.currentNum == 0 || this.state.currentName === "" ? 'disabled' : null} />
        </form>

        <ul>
        	{this.state.suitcase.map((item) => <SuitcaseItem state={item} />) }
        </ul>
      </div>
    );
  }
}