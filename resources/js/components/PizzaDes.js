import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class PizzaDes extends Component {

    constructor(props){
        super(props);
        this.state = {
            post: {}
        };  
    }

    componentDidMount(){

        axios.get("/api/pizza/" + this.props.match.params.id).then(response => {
            // this.setState({post : response.data[0] });

        }).catch(error => console.log(error));
    }

    render() {
        return ( 
            <div>
                {/* <h1> {this.state.post.name} </h1> */}
            </div>
        );
    }
}

 