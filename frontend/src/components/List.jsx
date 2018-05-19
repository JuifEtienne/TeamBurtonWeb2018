import React from 'react';
import axios from 'axios'
import styles from '../assets/sass/list.scss'

export default class List extends React.Component {
	constructor(props){
        super(props)
        
        this.state = {
            type: props.type,
        	currentNum: 0,
        	currentName: "",
            maxID: 0,
            list: []
        };
    }
    
    componentDidMount(){
        if(this.state.type === 'luggage'){
            axios.get('/luggage/1/content')
                .then(response => {
                this.setState({ list: response.data })
                console.log(response.data)
            })
                .catch(error => {console.log(error)})
        }
        else{
            axios.get('/paper/all')
                .then(response => {
                this.setState({ list: response.data })
            })
                .catch(error => {console.log(error)})
        }
    }

    addToList(event){
    	event.preventDefault();
        
        const tempObj = {id: this.state.maxID +1, name: this.state.currentName, number: this.state.currentNum, checked: false}
        
        /*if(this.state.type === 'luggage'){
            axios.post('/lugagge/1/add', tempObj)
                .then(response => {
                console.log(response)
            })
                .catch(error => {console.log(error)})
        }*/
        //else{
            axios.post('/paper/add', tempObj)
                .then(response => {
                console.log(response)
            })
                .catch(error => {console.log(error)})
        //}
        
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
        .catch(error => {console.log(error)})
        
        if(this.state.type === 'luggage'){
            axios.delete('/luggage/delete/idgive/from/1')
                .then(response => {
                console.log(response)
            })
                .catch(error => {console.log(error)})
        }
        //else{
            //axios.post('/paper/add', tempObj)
               // .then(response => {
               //  console.log(response)
            // })
            //    .catch(function (error) {
             //   console.log(error)
           // })
       // }
        
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
        const newElmt = this.state.list.find(i => i.id === id);
        const tempObject = {id: newElmt.id, name: newElmt.name, number: newElmt.number, checked: !newElmt.checked};
        const arr1 = this.state.list.filter(i => i.id < id);
        const arr2 = this.state.list.filter(i => i.id > id);
        this.setState({list: [...arr1, tempObject, ...arr2] });
        
        //axios.put('/luggage/1/update')
        axios.put('/paper/'+{id}+'/update')
        .then(response => {
            console.log(response)
        })
        .catch(error => {console.log(error)})
    } 
    
    printList(){
        return this.state.list.map(item =>{
            return <li className={'item ' + (item.checked ? 'unchecked' : 'checked')}>
                            <div>{item.name}</div>
                            <div>
                                <button onClick={() => this.onChekChange(item.id)} ></button>
                                <button className='delete' onClick={() => this.deleteFromList(item.id)}></button>
                            </div>
                    </li> 
        })
    }

  render() {
    return (
     <div>
     	<form className="list" onSubmit={(e) => this.addToList(e)} >
	        <input type="text" name="name" value={this.state.currentName} onChange={(e) => this.setCurrentName(e)}/>

	        

	        <input type="submit" value="+" disabled={this.state.currentNum === 0 || this.state.currentName === "" ? 'disabled' : null} />
        </form>

        <ul>
            {this.printList()}
        </ul>
      </div>
    );
  }
}

/* + et -

<input type="button" value="-" name="less" onClick={() => this.decreaseNum()}  disabled={this.state.currentNum == 0 ? 'disabled' : null}/>
	        <span>{this.state.currentNum}</span>
	        <input type="button" value="+" name="more" onClick={() => this.increaseNum()} />
*/