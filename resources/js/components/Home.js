import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Container, Header, Form, Label, Modal, Button } from 'semantic-ui-react';

class Home extends Component {

  static propTypes = {
    enterTheSite: PropTypes.func.isRequired
  }

  state = {
    enter: '',
    enterValid: true
  }

  handleChange = (e) => {
    this.setState({ enter: e.target.value })
  }

  handleEnterSubmit = () => {
    const enter = this.state.enter.toUpperCase().replace(/\s/g, "");
    this.props.history.push('/menu');
    this.props.enterTheSite(enter);
  }

  closeModal = () => {
    this.setState({
      enter: '',
      enterValid: true
    });
  }

  render(){

    return(
      <div id='home-page'>
        <Container >
        <center>
          <Header as='h1' id="home-logo">Pizza</Header>
        </center>
          <Container id="home-content">
          <center>
            <Header as='h1' id="home-header">The Best Pizzas Deliverey Website</Header>
            <Header as='h1' id="home-header">Made With Love To <a href="http://innoscripta.com"><b>Innoscripta</b></a> Co.</Header>
          </center>
            <center>
            <Form size='large' onSubmit={this.handleEnterSubmit} fluid='true'>
                <Form.Button type='submit' color='red' size='large' width={4} id='home-btn'>Get Started</Form.Button>
            </Form>
            </center>
            <center>
            <Header as='' id="home-header2">Created By <a href="https://linkedin.com/in/mohamed--said"><b>Mohamed Said</b></a></Header>
            <Header as='' id="home-header3">Thanks To <b>Aya Draganova </b><span id = "heart">&hearts;</span></Header>
            </center>

          </Container>
        </Container>
     </div>
     
    )
  }
};

export default Home;
