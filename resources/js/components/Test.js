// import React, { Component } from 'react';
// import ReactDOM from 'react-dom';
// import axios from 'axios';
// import {BrowserRouter as Router, Link, Route, browserHistory} from 'react-router-dom';

// export default class Test extends Component {

//     constructor(){
//         super();
//         this.state = {
//             pizzas: []
//         }
//     }

//     componentDidMount(){
//             axios.get('/api/pizza').then(response =>{
//                 this.setState({
//                     pizzas: [response.data]
//                 });
//             }).catch(errors => {
//                 console.log(errors);
//             })
//     }


//     render() {
//         return (             
//             <div className='container'>
//         {this.state.pizzas.map(pizza => <li key={Math.random()}> {console.log(pizza)}</li>)}
//             </div>
//         );
//     }

//     // render() {
//     //     return (             
//     //         <div className="container">
//     //             {this.state.pizzas.map(pizza => 
//     //                 <li key={Math.random()}>
//     //                 {console.log(pizza)}
//     //                 </li>
//     //             )}
//     //         </div>
//     //     );
//     // }
// }


import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Test extends React.Component {

    // constructor(props){
    //     super(props);
    //     this.state = {
    //         pizzas: []
    //     };  
    // }


    state = {
        pizzas: []
      }

    // componentDidMount(){

    //     axios.get("/api/pizza").then(response => {
    //         this.setState({
    //             pizzas : [response.data]
    //         });

    //     }).catch(error => {
    //         console.log(error)
    //     });
    // }

    componentDidMount() {
        axios.get("/api/pizza").then(response => response.data)
        .then((data) => {
          this.setState({ pizzas: [data] })
        //   console.log(this.state.pizzas)
         })
      }
      render(){
        return (
            <div className="container">
             <div className="col-xs-8">
             <h1>React Axios Example</h1>
             {this.state.pizzas.map((pizza) => (
               <div key={Math.random()} className="card">
                <div className="card-body">
                {console.log(pizza.pizzas)}
                    <h5 className="card-title">{pizza.id}</h5>
                   <h6 className="card-subtitle mb-2 text-muted">
                   {pizza.name}             
                   </h6>
                 </div>
               </div>
             ))}
             </div>
            </div>
         );
      }


    // render(){
    //     return(
    //         <ul>
    //         {/* {console.log(this.state.pizzas)} */}
    //         { this.state.pizzas.map(pizza => <li key={Math.random()}>{pizza.name}</li>)}
    //         </ul>
    //     )
    // }


    // {this.state.pizzas.map(item => (
    //     <li key={item}>The person is {item} years old.</li>
    //   ))}

    // render() {
    //     var test = this.state.pizzas[0];
    //     console.log(test);
    //     return ( 
    //         <div className="container">
    //         {this.state.pizzas.map(pizza =>{
    //         return (
    //             <li key={Math.random()} >
    //                 {/* { console.log(pizza.pizzas) }  */}
    //                 {pizza}
    //             </li>      
    //         );
    //         })
    //         }
    //         </div>
    //     );
    // }
}
if(document.getElementById('root')){
    ReactDOM.render(<Test />, document.getElementById('root'));
}

 

