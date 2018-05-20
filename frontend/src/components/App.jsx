import React from 'react'
import Menu from './Menu.jsx'
import Dashboard from './Dashboard.jsx'
import '../assets/sass/main.scss'
import styles from '../assets/sass/app.scss'
import Home from './Home.jsx'

export default class App extends React.Component {
    constructor(props){
        super(props)
        
        this.state = {
            currentPage: 0,
            numberOfJourney: 0
        };
        
        this.changeCurrent = this.changeCurrent.bind(this)
        this.currentElement = this.currentElement.bind(this)
        this.increaseJourney = this.increaseJourney.bind(this)
    }
    
    changeCurrent(i){
        this.setState({currentPage: i})
    }
    
    increaseJourney(){
        this.setState({numberOfJourney: ++this.state.numberOfJourney})
    }
    
    currentElement(id){
        if(id === 0){
            return <Home incrementJourney={this.increaseJourney}/>
        }
        else{
            return <Dashboard idPage={this.state.currentPage}/>
        }
    }
    
    
  render() {
    return (
     <div>
        <div id='menu'>   
            <Menu onMenuItemClick={this.changeCurrent} numberOfJourney={this.state.numberOfJourney} idPage={this.state.currentPage}/>
        </div>
        <div id='dashboard'>
            {this.currentElement(this.state.currentPage)}
        </div>
      </div>)
  }
}