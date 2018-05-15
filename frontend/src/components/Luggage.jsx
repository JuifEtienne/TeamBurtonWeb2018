import React from 'react';
import axios from 'axios'

export default class Luggage extends React.Component {
	constructor(props){
        super(props)
        
        this.state = {
        	currentNum: 0,
        	currentName: "",
            maxID: 0,
            luggage: []
        };
    }
    
    componentDidMount(){
        axios.get('/luggage/'+ this.props.idPage +'/content')
            .then(response => {
            this.setState({ luggage: response.data })
            console.log(response.data)
        })
            .catch(function (error) {
            console.log(error)
        })
    }
    
    static getDerivedStateFromProps(nextProps, prevState){
        console.log('here')
        axios.get('/luggage/'+ this.nextProps.idPage +'/content')
            .then(response => {
            return {luggage: response.data}
        })
            .catch(function (error) {
            console.log(error)
            return null
        })
    }

    addToList(event){
    	event.preventDefault();
        
        var tempObj = {id: this.state.maxID +1, name: this.state.currentName, quantity: this.state.currentNum, present: 0}
        
        
        axios.post('/luggage/'+ this.props.idPage +'/object/add', tempObj)
            .then(response => {
            console.log(response)
        })
            .catch(function (error) {
            console.log(error)
        })
        
		//this.setState({list: [...this.state.list, tempObj] });

		this.state.currentNum = 0;
		this.state.currentName = "";
        this.state.maxID++;
	}
    
    deleteFromList(idgive){
        axios.delete('/luggage/delete/idgive/from/1')
        .then(response => {
            console.log(response)
        })
        .catch(function (error) {
        console.log(error)
        })
        
        //this.setState(prevState => ({list: prevState.list.filter(i => i.id !== idgive)}))
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
    
    onChekChange(id){
        var newElmt = this.state.luggage.find(i => i.id === id);
        var tempObject = {id: newElmt.id, name: newElmt.name, quantity: newElmt.number, present: !newElmt.checked};
        var arr1 = this.state.luggage.filter(i => i.id < id);
        var arr2 = this.state.luggage.filter(i => i.id > id);
        this.setState({luggage: [...arr1, tempObject, ...arr2] });
        
        axios.put('/luggage/'+ this.props.idPage +'/update')
        .then(response => {
            console.log(response)
        })
        .catch(function (error) {
        console.log(error)
        })
    } 
    
    printList(){
        return this.state.luggage.map(item =>{
                                  return <li>
                                      <p>
                                        {item.name}
                                        <span>{item.quantity}</span>
                                        <button onClick={() => this.onChekChange(item.id)} >{item.present ? 'v' : '!'}</button>
                                        <button onClick={() => this.deleteFromList(item.id)}>X</button>
                                      </p>
                                  </li> })
    }

  render() {
    return (
     <div>
     	<form className="list" onSubmit={(e) => this.addToList(e)} >
	        <input type="text" name="name" value={this.state.currentName} onChange={(e) => this.setCurrentName(e)}/>

	        <input type="button" value="-" name="less" onClick={() => this.decreaseNum()}  disabled={this.state.currentNum == 0 ? 'disabled' : null}/>
	        <span>{this.state.currentNum}</span>
	        <input type="button" value="+" name="more" onClick={() => this.increaseNum()} />

	        <input type="submit" value="+" disabled={this.state.currentNum === 0 || this.state.currentName === "" ? 'disabled' : null} />
        </form>

        <ul>
            {this.printList()}
        </ul>
      </div>
    );
  }
}