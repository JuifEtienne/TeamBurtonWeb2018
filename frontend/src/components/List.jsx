import React from 'react';
import styles from '../assets/sass/list.scss'

export default class List extends React.Component {
	constructor(props){
        super(props)
        this.state = {
        	currentNum: 0,
        	currentName: "",
            maxID: 2,
            list: []
        };
    }

    addToList(event){
    	event.preventDefault();

    	var tempObj = {id: this.state.maxID +1, name: this.state.currentName, number: this.state.currentNum, checked: false}

		this.setState({list: [...this.state.list, tempObj] });

		this.state.currentNum = 0;
		this.state.currentName = "";
        this.state.maxID++;
	}
    
    deleteFromList(idgive){
        this.setState(prevState => ({list: prevState.list.filter(i => i.id !== idgive)}))
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
        var newElmt = this.state.list.find(i => i.id === id);
        var tempObject = {id: newElmt.id, name: newElmt.name, number: newElmt.number, checked: !newElmt.checked};
        var arr1 = this.state.list.filter(i => i.id < id);
        var arr2 = this.state.list.filter(i => i.id > id);
        this.setState({list: [...arr1, tempObject, ...arr2] });
    } 
    
    printList(){
        return this.state.list.map(item =>{
            return <li>
                        <p>
                            {item.name}
                            <span>{item.number}</span>
                            <button onClick={() => this.onChekChange(item.id)} >{item.checked ? 'v' : '!'}</button>
                            <button onClick={() => this.deleteFromList(item.id)}>X</button>
                        </p>
                    </li> 
        })
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