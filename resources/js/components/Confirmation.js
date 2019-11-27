import React, { Component, Fragment } from 'react';
import { Redirect } from 'react-router-dom';
import PropTypes from 'prop-types';
import { Container, Header, Menu, Image, Button } from 'semantic-ui-react';

import Footer from './Footer';

class Confirmation extends Component {
  static propTypes = {
    customerDetails: PropTypes.object,
    clearState: PropTypes.func.isRequired
  }

  state = {
    newOrder: false
  }

  handleClick = () => {
    this.props.clearState();
    this.setState({ newOrder: true });
  }

  render(){
    if(this.state.newOrder) {
      return <Redirect push to='/' />;
    }

    const { firstName, address } = this.props.customerDetails;

    return(
      <Fragment>
      <Menu secondary id='navbar'>
        <Menu.Item header id='navbar-header'>Pizza</Menu.Item>
      </Menu>
        <Container textAlign='center' id='confirmation-container'>
          <Header as='h1' id='page-header'>Thanks, {firstName}!</Header>
          <p id='confirmation-text'>We will deliver Your Order Soon :)</p>
          <p><strong>{address}</strong></p>
          <Image centered id='confirmation-img'  src='https://media2.giphy.com/media/PaKMBTzu2G0Qo/source.gif' />
          <Button onClick={this.handleClick} color='red' size='large' id='confirmation-new-btn'>Start A New Order</Button>
        </Container>
        <Footer />
      </Fragment>
    )
  }
};

export default Confirmation;
