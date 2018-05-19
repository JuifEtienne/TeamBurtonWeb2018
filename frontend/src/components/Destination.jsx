import React from 'react';
import styles from '../assets/sass/destination.scss'

export default class Destination extends React.Component {

  constructor(props){
      super(props)
      this.state = {
        map: null,
        country: 'France',
        city: 'Paris',
        localTime: 9,
        beginningDate: '2018-06-02',
        endingDate: '2018-06-30'
      }

  }

  calcTimeDiff(){
    var today = new Date();
    console.log(this.state.localTime)
    return today.getHours() - this.state.localTime;
  }

  getMapSearch(){
    return "https://www.google.com/maps/embed/v1/place?key=AIzaSyBeqJKvn6UBcOg9M558PX-AadD2IoRX6ts&q="+this.state.city
  }

  render() {

    return (
    <div className='dest'>
      <iframe
        height="500"
        frameborder="0"
        src={this.getMapSearch()} allowfullscreen>
      </iframe>
        <div className='container'>    
      <form className='info'>
        <select name='country'>
          <option value='France'>France</option>
          <option value='Great Britain'>Great Britain</option>
          <option value='Germany'>Germany</option>
        </select>

        <select name='City'>
          <option value='Paris'>Paris</option>
          <option value='Berlin'>Berlin</option>
          <option value='London'>London</option>
        </select>
        
        <div className='dates'>
            <input type="date" name="beginning" value={this.state.beginningDate} />
            <input type="date" name="ending" value={this.state.endingDate}  min={this.state.beginningDate}/>
        </div>

        <p>Local time: <span>{this.state.localTime}</span></p>
        <p id='interval'>{this.calcTimeDiff()}h</p>
        <input type='submit' value='Update changes' />
      </form>
            </div>
    </div>
    );
  }
}

/*
AIzaSyBeqJKvn6UBcOg9M558PX-AadD2IoRX6ts
*/