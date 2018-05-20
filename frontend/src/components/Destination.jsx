import React from 'react'
import styles from '../assets/sass/destination.scss'

import keys from '../settings/settings.json'

import axios from 'axios'


export default class Destination extends React.Component {

  constructor(props){
      super(props)
      this.state = {
        map: null,
        city: 'Champs-Sur-Marne',
        localTime: 9,
        idTimeZone: 0,
        beginningDate: '2018-06-02',
        endingDate: '2018-06-30',
        countries: [],
        cities: [],
        idCountrySelect: 0,
        idCitySelect: 0
      }

      this.changeIdCountry = this.changeIdCountry.bind(this)
      this.changeIdCity = this.changeIdCity.bind(this)
      this.changeFirstDate = this.changeFirstDate.bind(this)
      this.changeSecondDate = this.changeSecondDate.bind(this)
  }
    
    componentDidMount(){
        axios.get('/country/all')
            .then(response => {
            this.setState({ countries: response.data })
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
        
        axios.get('/destination/' + this.props.idPage)
            .then(response => {
            this.setState({beginningDate: response.data.arrivalDate, endingDate: response.data.departureDate, idCitySelect: response.data.idCity})
            // console.log(response.data)
            
            this.changeTimeAndCity(response)
        
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
    }
    
    componentWillReceiveProps(nextProps){
       axios.get('/destination/' + nextProps.idPage)
            .then(response => {
            this.setState({beginningDate: response.data.arrivalDate, endingDate: response.data.departureDate, idCitySelect: response.data.idCity})
            // console.log(response.data)
            
            this.changeTimeAndCity(response)
            
            console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
   }
    
    updateCities(id){
        axios.get('/country/'+ id +'/cities')
            .then(response => {
            this.setState({ cities: response.data })
            // console.log("Update")
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
    }
    
    updateCitiesAndFirstSelect(id){
        axios.get('/country/'+ id +'/cities')
            .then(response => {
            this.setState({ cities: response.data, idCitySelect: response.data[0].id, city: response.data[0].name})
            // console.log("Update")
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
    }
    
    changeDestinationCity(event){
        event.preventDefault()
        
        const newDest = {arrivalDate: this.state.beginningDate ,departureDate: this.state.endingDate,idJourney: this.props.idPage,idCity: this.state.idCitySelect}
        
        axios.put('/destination/'+ this.props.idPage +'/update', newDest)
            .then(response => {
            // console.log(response.data)
            
            this.changeTimeAndCity(response)
            this.props.willChange();
        })
            .catch(error => {
            console.log(error)
        })
    }
    
  changeTimeAndCity(response){
      axios.get('/city/' + response.data.idCity)
                .then(response2 => {
                this.setState({ idCountrySelect: response2.data.idCountry, idTimeZone:  response2.data.idTimeZone, city: response2.data.name})
                this.updateCities(response2.data.idCountry)
                // console.log(response2.data)
                
                axios.get('/timezone/' + response2.data.idTimeZone + '/hour')
                    .then(response => {
                    this.setState({ localTime: response.data.localHour })
                    // console.log(response.data)
                })
                    .catch(error => {
                    console.log(error)
                })
            })
                .catch(error => {
                console.log(error)
            })
  }

  calcTimeDiff(){
    const today = new Date()
    const localHour = today.getHours()

    return localHour - parseInt(this.state.localTime.toString().split(':')[0])
  }

  getMapSearch(){
    return "https://www.google.com/maps/embed/v1/place?key="+keys.googleMap+"&q="+this.state.city
  }
    
  changeIdCountry(event){
    this.setState({idCountrySelect: event.target.value})
    this.updateCitiesAndFirstSelect(event.target.value)
  }
    
  changeIdCity(event){
    this.setState({idCitySelect: parseInt(event.target.value.split('|')[0])})
    this.setState({city:event.target.value.split('|')[1]})
  }
    
  changeFirstDate(event){
    this.setState({beginningDate: event.target.value})
      
    var newDest = {arrivalDate: event.target.value,departureDate: this.state.endingDate,idJourney: this.props.idPage,idCity: this.state.idCitySelect}
        
    axios.put('/destination/'+ this.props.idPage +'/update', newDest)
        .then(response => {
        // console.log(response.data)

        this.changeTimeAndCity(response)
    })
        .catch(error => {
        console.log(error)
    })
  }
    
  changeSecondDate(event){
    this.setState({endingDate: event.target.value})
      
    var newDest = {arrivalDate: this.state.beginningDate,departureDate: event.target.value,idJourney: this.props.idPage,idCity: this.state.idCitySelect}
        
    axios.put('/destination/'+ this.props.idPage +'/update', newDest)
        .then(response => {
        // console.log(response.data)

        this.changeTimeAndCity(response)
    })
        .catch(error => {
        console.log(error)
    })
  }
    

  render() {

    return (
    <div className='dest'>
      <iframe
        height={500}
        frameBorder={0}
        src={this.getMapSearch()} allowFullScreen={true}>
      </iframe>
        <div className='wrapper'>    
          <form className='info'>
            <select name='country' value={this.state.idCountrySelect} onChange={this.changeIdCountry}>
                {this.state.countries.map(i => <option key={i.id} value={i.id}>{i.name}</option>)}
            </select>

            <select name='city' value={this.state.idCitySelect + '|' + this.state.city} onChange={this.changeIdCity}>
                {this.state.cities.map(i => <option key={i.id} value={i.id + '|' + i.name}>{i.name}</option>)}
            </select>

            <div className='dates'>
                <input type="date" name="beginning" value={this.state.beginningDate} max={this.state.endingDate} onChange={this.changeFirstDate}/>
                <input type="date" name="ending" value={this.state.endingDate}  min={this.state.beginningDate} onChange={this.changeSecondDate}/>
            </div>

            <p>Local time: <span>{this.state.localTime}</span></p>
            <p id='interval'>{this.calcTimeDiff()}h</p>
            <input type='submit' value='Update changes' onClick={(e) => this.changeDestinationCity(e)} />
          </form>
        </div>
    </div>
    )
  }
}
