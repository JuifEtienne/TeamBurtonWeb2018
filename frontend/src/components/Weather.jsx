import React from 'react'
import styles from '../assets/sass/weather.scss'
import axios from 'axios'
import {Line} from 'react-chartjs-2'
import keys from '../settings/settings.json'
import sun from '../assets/img/sun.svg'
import cloud from '../assets/img/cloud.svg'
import rain from '../assets/img/tint.svg'

export default class Panel extends React.Component {

  constructor(props){
      super(props)
      this.state = {
        town: 'paris',
        forecast : null
      }

      this.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
      'Nov', 'Dec']

  }

  componentDidMount(){
      axios.get('/destination/' + this.props.idPage)
            .then(response => {
             axios.get('/city/' + response.data.idCity)
                .then(response2 => {
                this.setState({town: response2.data.name})
                axios.get('http://api.openweathermap.org/data/2.5/forecast?q='+response2.data.name+'&units=metric&APPID='+keys.openWeather)
                .then(response3 => {
                  //console.log(response.data);
                  this.setState({ forecast: response3.data })
                })
                .catch(error => {
                  console.log(error)
                })
            })
                .catch(error => {
                console.log(error)
            })
            
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
    }
    
  componentWillReceiveProps(nextProps){
       axios.get('/destination/' + nextProps.idPage)
            .then(response => {
             axios.get('/city/' + response.data.idCity)
                .then(response2 => {
                this.setState({town: response2.data.name})
                axios.get('http://api.openweathermap.org/data/2.5/forecast?q='+response2.data.name+'&units=metric&APPID='+keys.openWeather)
                .then(response3 => {
                  //console.log(response.data);
                  this.setState({ forecast: response3.data })
                })
                .catch(error => {
                  console.log(error)
                })
            })
                .catch(error => {
                console.log(error)
            })
            
            // console.log(response.data)
        })
            .catch(error => {
            console.log(error)
        })
   }
    
    displayWeather(item) {
        if (item === 'Clouds') {
            return cloud
        }
        else if (item === 'Clear') {
            return sun
        }
        else {
            return rain
        }
    }

  printList(){
    const arraysprint = [];

    if(this.state.forecast == null){
      return "Error, forecast unavailable"
    }

    for(let i=0; i < this.state.forecast.list.length; i=i+8){
      arraysprint.push(this.state.forecast.list[i])
    }

    // console.log(arraysprint)
    let j = 0;
    return arraysprint.map(item =>{
        
      const date = new Date(item.dt*1000);
        return <tr key={j++}>
            <td>
            {date.getDate()} {this.months[date.getMonth()]} {date.getFullYear()}
            </td>
            <td><img src={this.displayWeather(item.weather[0].main)}></img></td>
            <td>{item.main.temp}°C</td>
            <td>{item.wind.speed} m/s
            </td>
        </tr>
    })
  }

  diagramData(){
    const labelData = []
    const tempData = []
    const humidityData = []
    const windData = []

    const arrays = []

    if(this.state.forecast == null){
      return {}
    }

      for(let i=0; i < this.state.forecast.list.length; i=i+4){
      arrays.push(this.state.forecast.list[i])
    }

    arrays.map(item => {
      const date = new Date(item.dt*1000);

      labelData.push(date.getDate() + ' ' + this.months[date.getMonth()] + ' ' + date.getFullYear() + ' ' + date.getHours() + 'h')
      tempData.push(item.main.temp)
      humidityData.push(item.main.humidity)
      windData.push(item.wind.speed)
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
          }
          /*{
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
          }*/
        ]
      }
  }

  diagramOptions(){
    return {
      scales: {
        xAxes: [{
          display: false
        }]
      },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    }
  }

  render() {
    return (
     <div className='grid weather'>
        <div className='xl-6'>
            <p className='text-center'>{this.state.town}</p>
            <Line data={this.diagramData()} options={this.diagramOptions()} height={200} />
        </div> 
      <div className='xl-6'>
        <p className='text-center'>Forecast</p>
        <table>
            <tbody>
                {this.printList()}
            </tbody>
        </table>
      </div>
    </div>
    );
  }
}
