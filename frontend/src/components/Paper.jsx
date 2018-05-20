import React from 'react'
import axios from 'axios'

export default class Paper extends React.Component {
	constructor(props){
        super(props)
        
        this.state = {
        	currentName: "",
            maxID: 0,
            paper: []
        }
    }
    
    componentDidMount(){
        axios.get('/destination/'+ this.props.idPage +'/papers')
            .then(response => {
            this.setState({ paper: response.data })
            // console.log(response.data)
        })
            .catch(error => {console.log(error)})
    }
    
    updatePaper(){
        axios.get('/destination/'+ this.props.idPage +'/papers')
            .then(response => {
            this.setState({ paper: response.data })
            // console.log(response.data)
        })
            .catch(error => {console.log(error)})
    }
    
   componentWillReceiveProps(nextProps){
       axios.get('/destination/'+ nextProps.idPage +'/papers')
            .then(response => {
            this.setState({ paper: response.data })
            // console.log(response.data)
        })
            .catch(error => {console.log(error)})
   }
    
    addPaper(event){
        event.preventDefault();
        
        const newObj = {name: this.state.currentName}
        
        axios.post('/paper/add', newObj)
            .then(response => {
            // console.log(response)
            this.findObjectId(event, this.state.currentName)
        })
            .catch(error => {console.log(error)})
        
        this.state.maxID++
    }
    
    findObjectId(event, nameCheck){
        axios.get('/paper/all')
            .then(response => {
            console.log(response.data)
            this.addToList(event, response.data.find(i => i.name === nameCheck).id)          
        })
            .catch(error => {console.log(error)})
    }
    
    
    addToList(event, id){
        event.preventDefault();
        const tempPap = {valid: 0, owner: 'M Nobody', description: "Null"}

        axios.post('/destination/'+ this.props.idPage +'/paper/'+ id +'/add', tempPap)
            .then(response => {
            console.log(response)
            this.state.currentName = ""
            this.updatePaper();
        })
            .catch(error => {console.log(error)})
        
		//this.setState({list: [...this.state.list, tempObj] });
	}
    
    deleteFromList(idgive){
        axios.delete('/destination/'+ this.props.idPage +'/paper/'+ idgive +'/delete')
        .then(response => {
            console.log(response)
            this.updatePaper()
        })
        .catch(error => {console.log(error)})
        
        //this.setState(prevState => ({list: prevState.list.filter(i => i.id !== idgive)}))
    }

	setCurrentName(event){
		this.setState({currentName: event.target.value})
	}
    
    onChekChange(id){
       axios.get('/destination/'+ this.props.idPage +'/papers')
            .then(response => {
               const pres = response.data.find(i=> i.id === id).valid
               console.log(1 - pres)
               axios.put('/destination/'+ this.props.idPage +'/paper/'+ id +'/update', {valid: 1 - pres, owner: 'M Nobody', newOwner: 'M Nobody', description: "Null"})
                .then(response => {
                    // console.log(response)
                    this.updatePaper()
                })
                .catch(error => {console.log(error)})
        })
            .catch(error => {console.log(error)})
    } 
    
    printList(){
        return this.state.paper.map(item =>{
            return <li key={item.id} className={'item ' + (item.valid ? 'unchecked' : 'checked')}>
                        <div>{item.name}</div>
                        <div>{item.quantity}</div>
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
     	<form className="list" onSubmit={(e) => this.addPaper(e)} >
	        <input type="text" name="name" value={this.state.currentName} onChange={(e) => this.setCurrentName(e)}/>

	        <input type="submit" value="+" disabled={this.state.currentName === "" ? 'disabled' : null} />
        </form>

        <ul>
            {this.printList()}
        </ul>
      </div>
    )
  }
}