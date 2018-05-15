import React from 'react';
import styles from '../assets/sass/menu.scss'
import axios from 'axios'

export default class Menu extends React.Component {
    constructor(props){
        super(props)
        this.state = {
            voyages: []
        }
    }
    
    componentDidMount(){
        axios.get('/journey/all')
        .then(response => {
            this.setState({ voyages: response.data })
            console.log('here')
        })
        .catch(function (error) {
        console.log(error)
        })
    }

    
  render() {
    return (
     <div>  
        <img src={require('../assets/img/logo.svg')} alt='logo'/>            
        <h2>Journeo</h2>
            <nav className='nav' role='navigation'>
                <ul className='menu'>
                    <li>
                        <a onClick={() => this.props.onMenuItemClick(0)}>
                            <div>icone</div>
                            <div>Home</div>
                        </a>
                    </li>
                    {
                        this.state.voyages.map((item) =>
                            <li><a onClick={() => this.props.onMenuItemClick(item.id)}>
                                <div>icone</div>
                                <div>{item.name}</div>
                            </a></li>
                        )
                    }
                </ul>
            </nav>
        <p>© 2018 - Team Burton</p>
      </div>
    );
  }
}