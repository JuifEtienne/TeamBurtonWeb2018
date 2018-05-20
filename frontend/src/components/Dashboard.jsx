import React from 'react'
import axios from 'axios'
import Panel from './Panel.jsx'
import styles from '../assets/sass/dashboard.scss'

import List from './List.jsx'
import Paper from './Paper.jsx'
import Luggage from './Luggage.jsx'
import Weather from './Weather.jsx'
import Destination from './Destination.jsx'

export default class Dashboard extends React.Component {
  constructor(props){
        super(props)

        this.state = {
            pageWillChange: 0,
        }

        this.change = this.change.bind(this)
    }

    change(){
        this.setState({pageWillChange: this.state.pageWillChange++})
    }
    
    deleteTrip() {
        axios.delete('/journey/'+this.props.idPage+'/delete')
            .then(response => {
            console.log(response)
        })
            .catch(error => {
            console.log(error)
        })
    }
    
  render() {
    return (
        <div>
            <Destination idPage={this.props.idPage} willChange={this.change}/>
            <div className='panel-container'>
                <div className='wrapper'>
                    <div className='grid'>

                        <article className='xl-7'>
                            <Panel title={'Suitcase'}>
                              <Luggage idPage={this.props.idPage}/>
                            </Panel>
                        </article>

                        <article className='xl-5'>
                            <Panel title={'Paper copies'}>
                              <Paper idPage={this.props.idPage} type={'paper'} />
                            </Panel>
                        </article>
                        
                        <article className='xl-12'>
                            <Panel title={'Weather'}>
                              <Weather idPage={this.props.idPage} willChange={this.state.pageWillChange}/>
                            </Panel>
                        </article>
                        <button className='deleteTrip' onClick={() => this.deleteTrip()}><span className='ti-trash'></span> Delete this trip</button>
                    </div>
                </div>
            </div>
        </div>
    )
  }
}