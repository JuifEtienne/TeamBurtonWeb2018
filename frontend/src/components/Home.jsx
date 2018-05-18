import React from 'react';
import axios from 'axios';
import Panel from './Panel.jsx'

export default class Home extends React.Component {
    constructor(props){
        super(props)
        
        this.state = {
            type: props.type,
        	currentName: "",
        };
    }

    addToList(event){
    	event.preventDefault();
        
        var tempObj = {name: this.state.currentName, startingDate:'1111-11-11', endingDate:'1111-11-11'}
        
        //Creation d'un voyage
        axios.post('/journey/add', tempObj)
            .then(response => {
            console.log(response)
            this.props.incrementJourney();
        })
            .catch(function (error) {
            console.log(error)
        })
        
        //Creation du bagage associé
        var newLuggage = {name: this.state.currentName}
        
        axios.post('/luggage/add', newLuggage)
            .then(response => {
            console.log(response)
        })
            .catch(function (error) {
            console.log(error)
        })

        
		this.state.currentName = "";
	}

	setCurrentName(event){
		this.setState({currentName: event.target.value});
	}
    
  render() {
    return (
     <div>
        <h1>Hello World</h1>
        <p> Welcome to Journeo</p>
        <Panel title={'Nouveau voyage'}>   
            <div>
     	<form className="list" onSubmit={(e) => this.addToList(e)} >
	        <input type="text" name="name" value={this.state.currentName} onChange={(e) => this.setCurrentName(e)}/>
	        <input type="submit" value="+" disabled={this.state.currentName === "" ? 'disabled' : null} />
        </form>
      </div>
        </Panel>
      </div>
    );
  }
}