import React from 'react';
import styles from '../assets/sass/menu.scss'

export default class Menu extends React.Component {
  render() {
    return (
     <div>  
        <img src={require('../assets/img/logo.svg')} alt='logo'/>            
        <h2>Journeo</h2>
            <nav className='nav' role='navigation'>
                <ul className='menu'>
                    <li>
                        <a>
                            <div>icone</div>
                            <div>Home</div>
                        </a>
                    </li>
                    <li><a>
                            <div>icone</div>
                            <div>1st trip</div>
                        </a>
                    </li>
                </ul>
            </nav>
        <p>© 2018 - Team Burton</p>
      </div>
    
    );
  }
}