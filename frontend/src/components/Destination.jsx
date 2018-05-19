import React from 'react';
import styles from '../assets/sass/panel.scss'
import keys from '../settings/settings.json'

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
    return "https://www.google.com/maps/embed/v1/place?key="+keys.googleMap+"&q="+this.state.city
  }

  render() {

    return (
    <div className='dest'>
      <iframe
        width="600"
        height="450"
        frameborder="0"
        src={this.getMapSearch()} allowfullscreen>
      </iframe>
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

        <input type="date" name="beginning" value={this.state.beginningDate} />
        <input type="date" name="ending" value={this.state.endingDate}  min={this.state.beginningDate}/>

        <p>Local time: <span>{this.state.localTime}</span></p>
        <p>{this.calcTimeDiff()}</p>
        <input type='submit' value='Update changes' />
      </form>
    </div>
    );
  }
}

/*

*/