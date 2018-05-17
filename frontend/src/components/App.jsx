import React from 'react';
import Menu from './Menu.jsx';
import Dashboard from './Dashboard.jsx'
import styles from '../assets/sass/app.scss';
import Home from './Home.jsx'

export default class App extends React.Component {
    constructor(props){
        super(props)
        
        this.state = {
            currentPage: 0
        };
        
        this.changeCurrent = this.changeCurrent.bind(this)
        this.currentElement = this.currentElement.bind(this)
    }
    
    changeCurrent(i){
        this.setState({currentPage: i});
    }
    
    currentElement(id){
        if(id === 0){
            return <Home />
        }
        else{
            console.log(this.state.currentPage)
            return <Dashboard idPage={this.state.currentPage}/>
        }
    }
    
    
  render() {
    return (
     <div>
        <div id='menu'>   
            <Menu onMenuItemClick={this.changeCurrent} />
        </div>
        <div id='dashboard'>
            {//<Dashboard idPage={this.currentPage}/> 
        }
            {this.currentElement(this.state.currentPage)}
        </div>
      </div>);
  }
}