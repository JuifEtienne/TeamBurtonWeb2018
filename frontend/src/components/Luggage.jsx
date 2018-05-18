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
    
    updateLuggage(){
        axios.get('/luggage/'+ this.props.idPage +'/content')
            .then(response => {
            this.setState({ luggage: response.data })
            console.log(response.data)
        })
            .catch(function (error) {
            console.log(error)
        })
    }
    
   componentWillReceiveProps(nextProps){
       axios.get('/luggage/'+ nextProps.idPage +'/content')
            .then(response => {
            this.setState({ luggage: response.data })
            console.log(response.data)
        })
            .catch(function (error) {
            console.log(error)
        })
   }
    
    addObject(event){
        event.preventDefault();
        
        var newObj = {name: this.state.currentName}
        
        axios.post('/object/add', newObj)
            .then(response => {
            console.log(response)
            this.findObjectId(event, this.state.currentName)
        })
            .catch(function (error) {
            console.log(error)
        })
        
        this.state.maxID++;
    }
    
    findObjectId(event, nameCheck){
        axios.get('/object/all')
            .then(response => {
            console.log(response.data)
            this.addToList(event, response.data.find(i => i.name === nameCheck).id)          
        })
            .catch(function (error) {
            console.log(error)
            
        })
    }
    
    
    addToList(event, id){
        event.preventDefault();
        var tempLug = {quantity: this.state.currentNum, present: 0}

        axios.post('/luggage/'+ this.props.idPage +'/object/'+ id +'/add', tempLug)
            .then(response => {
            console.log(response)
            this.state.currentName = "";
            this.state.currentNum = 0;
            this.updateLuggage();
        })
            .catch(function (error) {
            console.log(error)
        })
        
		//this.setState({list: [...this.state.list, tempObj] });
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
     	<form className="list" onSubmit={(e) => this.addObject(e)} >
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