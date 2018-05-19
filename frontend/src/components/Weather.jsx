import React from 'react';
import styles from '../assets/sass/weather.scss'
import axios from 'axios'
import {Line} from 'react-chartjs-2'
import keys from '../settings/settings.json'

export default class Panel extends React.Component {

  constructor(props){
      super(props)
      this.state = {
        town: 'paris',
        forecast : null
      }

      this.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
      'Nov', 'Dec'];

  }

  componentDidMount(){
        axios.get('http://api.openweathermap.org/data/2.5/forecast?q='+this.state.town+'&units=metric&APPID='+keys.openWeather)
        .then(response => {
          //console.log(response.data);
          this.setState({ forecast: response.data })
        })
        .catch(function (error) {
          console.log(error)
        })
    }

  printList(){
    const arraysprint = [];

    if(this.state.forecast == null){
      return "Error, forecast unavailable"
    }

    for(var i=0; i < this.state.forecast.list.length; i=i+8){
      arraysprint.push(this.state.forecast.list[i]);
    }

    console.log(arraysprint)

    return arraysprint.map(item =>{
      const date = new Date(item.dt*1000);
      return <li>
        {date.getDate()} {this.months[date.getMonth()]} {date.getFullYear()}&emsp;
        <span className='icon'>{item.weather[0].main}</span>&emsp;
        <span className='temp'>{item.main.temp}°C</span>&emsp;
        {item.wind.speed} m/s
      </li>
    })
  }

  diagramData(){
    const labelData = [];
    const tempData = [];
    const humidityData = [];
    const windData = [];

    const arrays = [];

    if(this.state.forecast == null){
      return {}
    }

    for(var i=0; i < this.state.forecast.list.length; i=i+4){
      arrays.push(this.state.forecast.list[i]);
    }

    arrays.map(item => {
      const date = new Date(item.dt*1000);

      labelData.push(date.getDate() + ' ' + this.months[date.getMonth()] + ' ' + date.getFullYear() + ' ' + date.getHours() + 'h');
      tempData.push(item.main.temp);
      humidityData.push(item.main.humidity);
      windData.push(item.wind.speed);
    })

    return {
        labels: labelData,
        datasets: [
          {
            label: 'Temperature',
            fill: false,
            lineTension: 0.3,
            backgroundColor: 'rgba(192,64,255,0.4)',
            borderColor: 'rgba(192,64,255,1)',
            pointBackgroundColor: '#9B35C5',
            pointHoverRadius: 5,
            pointHoverBackgroundColor: 'rgba(192,64,255,0.8)',
            pointRadius: 3,
            pointHitRadius: 10,
            data: tempData
          },
          {
            label: 'Humidity',
            fill: false,
            lineTension: 0.3,
            backgroundColor: 'rgba(243,119,120,0.4)',
            borderColor: 'rgba(243,119,120,1)',
            pointBackgroundColor: '#F37778',
            pointHoverRadius: 5,
            pointHoverBackgroundColor: 'rgba(243,119,120,0.8)',
            pointRadius: 3,
            pointHitRadius: 10,
            data: humidityData
          },
          {
            label: 'Wind speed',
            fill: false,
            lineTension: 0.3,
            backgroundColor: 'rgba(119,243,173,0.4)',
            borderColor: 'rgba(119,243,173,1)',
            pointBackgroundColor: '#77F3AD',
            pointHoverRadius: 5,
            pointHoverBackgroundColor: 'rgba(119,243,173,0.8)',
            pointRadius: 3,
            pointHitRadius: 10,
            data: windData
          }
        ]
      }
  }

  diagramOptions(){
    return {
      scales: {
        xAxes: [{
          display: false
        }]
      }
    }
  }

  render() {
    return (
     <div className='weather'>
      <Line data={this.diagramData()} options={this.diagramOptions()} width='500' height='250' />
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



*/