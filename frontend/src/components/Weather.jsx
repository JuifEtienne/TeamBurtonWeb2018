import React from 'react';
import styles from '../assets/sass/panel.scss'
import axios from 'axios'

export default class Panel extends React.Component {

  constructor(props){
      super(props)
      this.state = {
        forecast : null
      }

      this.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
      'Nov', 'Dec'];
  }



  componentDidMount(){
        axios.get('http://api.openweathermap.org/data/2.5/forecast?q=paris&units=metric&APPID=cf2d03b36ba7b9f74adddecc430b584a')
        .then(response => {
          //console.log(response.data);
          this.setState({ forecast: response.data })
        })
        .catch(function (error) {
          console.log(error)
        })
    }

  printList(){
    var arrays = [];
    var size = 8;

    if(this.state.forecast == null){
      return <p>Error, forecast unavailable</p>
    }

    while(this.state.forecast.list.length > 0){
      arrays.push(this.state.forecast.list.splice(0, size));
    }

    //console.log(arrays);

    return arrays.map(item =>{
      var date = new Date(item[0].dt*1000);
      return <p>
        {date.getDate()} {this.months[date.getMonth()]} {date.getFullYear()}&emsp;
        <span className='icon'>{item[0].weather[0].main}</span>&emsp;
        <span className='temp'>{item[0].main.temp}°C</span>&emsp;
        {item[0].speed}m/s
      </p>
    })
  }

  render() {
    return (
     <div className='weather'>
      <div>
        <h3>Forecast</h3>
        <ul>
          {this.printList()}
        </ul>
      </div>
    </div>
    );
  }
}

/*
http://api.openweathermap.org/data/2.5/forecast?q=paris&units=metric&APPID=cf2d03b36ba7b9f74adddecc430b584a


  componentDidMount(){
    fetch("http://api.openweathermap.org/data/2.5/forecast?q=paris&units=metric&APPID=cf2d03b36ba7b9f74adddecc430b584a")
    .then(res => res.json())
    .then(
      (result) => {
        this.forecast = result.items;
      },
      (error) => {
        console.log('Weather API error !');
        this.forecast = {"cod":"200","message":0.0024,"cnt":6,"list":[{"dt":1526299200,"main":{"temp":12.35,"temp_min":12.15,"temp_max":12.35,"pressure":1015.56,"sea_level":1027.67,"grnd_level":1015.56,"humidity":97,"temp_kf":0.2},"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":{"all":92},"wind":{"speed":6.31,"deg":348},"rain":{"3h":2.4225},"sys":{"pod":"d"},"dt_txt":"2018-05-14 12:00:00"},{"dt":1526310000,"main":{"temp":14.01,"temp_min":13.87,"temp_max":14.01,"pressure":1015.34,"sea_level":1027.3,"grnd_level":1015.34,"humidity":94,"temp_kf":0.13},"weather":[{"id":501,"main":"Rain","description":"moderate rain","icon":"10d"}],"clouds":{"all":100},"wind":{"speed":5.67,"deg":345.001},"rain":{"3h":3.02},"sys":{"pod":"d"},"dt_txt":"2018-05-14 15:00:00"},{"dt":1526320800,"main":{"temp":16.85,"temp_min":16.79,"temp_max":16.85,"pressure":1014.88,"sea_level":1026.81,"grnd_level":1014.88,"humidity":89,"temp_kf":0.07},"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10d"}],"clouds":{"all":32},"wind":{"speed":5.81,"deg":345.501},"rain":{"3h":0.45},"sys":{"pod":"d"},"dt_txt":"2018-05-14 18:00:00"},{"dt":1526331600,"main":{"temp":13.82,"temp_min":13.82,"temp_max":13.82,"pressure":1015.96,"sea_level":1027.92,"grnd_level":1015.96,"humidity":87,"temp_kf":0},"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01n"}],"clouds":{"all":0},"wind":{"speed":6.31,"deg":343.005},"rain":{},"sys":{"pod":"n"},"dt_txt":"2018-05-14 21:00:00"},{"dt":1526342400,"main":{"temp":12.43,"temp_min":12.43,"temp_max":12.43,"pressure":1016.37,"sea_level":1028.36,"grnd_level":1016.37,"humidity":87,"temp_kf":0},"weather":[{"id":500,"main":"Rain","description":"light rain","icon":"10n"}],"clouds":{"all":0},"wind":{"speed":5.82,"deg":345.001},"rain":{"3h":0.0024999999999995},"sys":{"pod":"n"},"dt_txt":"2018-05-15 00:00:00"},{"dt":1526353200,"main":{"temp":11.33,"temp_min":11.33,"temp_max":11.33,"pressure":1016.57,"sea_level":1028.71,"grnd_level":1016.57,"humidity":90,"temp_kf":0},"weather":[{"id":800,"main":"Clear","description":"clear sky","icon":"01n"}],"clouds":{"all":0},"wind":{"speed":5.11,"deg":346.501},"rain":{},"sys":{"pod":"n"},"dt_txt":"2018-05-15 03:00:00"}],"city":{"id":2988507,"name":"Paris","coord":{"lat":48.8566,"lon":2.3515},"country":"FR","population":2138551}};
      }
    )
  }

*/