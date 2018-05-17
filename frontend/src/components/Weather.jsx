import React from 'react';
import styles from '../assets/sass/panel.scss'
import axios from 'axios'
import {Line} from 'react-chartjs-2'

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
        axios.get('http://api.openweathermap.org/data/2.5/forecast?q='+this.state.town+'&units=metric&APPID=cf2d03b36ba7b9f74adddecc430b584a')
        .then(response => {
          //console.log(response.data);
          this.setState({ forecast: response.data })
        })
        .catch(function (error) {
          console.log(error)
        })
    }

  printList(){
    //console.log('thiss state forecast :')
    //console.log(this.state.forecast)
    var arrays = [];
    var size = 8;

    if(this.state.forecast == null){
      //console.log('error forecast printlist func')
      return "Error, forecast unavailable"
    }

    //console.log('forecast list into printlist func')


    while(this.state.forecast.list.length > 0){
      arrays.push(this.state.forecast.list.splice(0, size));
    }

    //console.log('printlist arrays :')
    //console.log(arrays);

    return arrays.map(item =>{
      var date = new Date(item[0].dt*1000);
      <p>
        {date.getDate()} {this.months[date.getMonth()]} {date.getFullYear()}&emsp;
        <span className='icon'>{item[0].weather[0].main}</span>&emsp;
        <span className='temp'>{item[0].main.temp}°C</span>&emsp;
        {item[0].wind.speed} m/s
      </p>
    })
  }

  diagramData(){

    //console.log('thiss state forecast into diagram func:')
    //console.log(this.state.forecast)    

    var labelData = [];
    var tempData = [];
    var humidityData = [];
    var windData = [];

    var arrays = [];
    var size = 4;

    if(this.state.forecast == null){
      //console.log('error forecast diagram data func')
      return {}
    }

    while(this.state.forecast.list.length > 0){
      arrays.push(this.state.forecast.list.splice(0, size));
    }

    //console.log('arrays in diagram data :')
    //console.log(arrays);

    arrays.map(item => {
      var date = new Date(item[0].dt*1000);

      labelData.push(date.getDate() + ' ' + this.months[date.getMonth()] + ' ' + date.getFullYear() + ' ' + date.getHours() + 'h');
      tempData.push(item[0].main.temp);
      humidityData.push(item[0].main.humidity);
      windData.push(item[0].wind.speed);
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