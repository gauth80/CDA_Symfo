import React from 'react';
// react router dom
import {Link as LinkRouter} from 'react-router-dom';
// Material ui
import { AppBar} from '@material-ui/core';
import useStyles from './styles';


const Navbar = props => {
  const classes = useStyles();

  return(
    <AppBar color="secondary" className={classes.navbar}>
      <LinkRouter to = "/home" >Home</LinkRouter>
      <LinkRouter to = "/contact">Contact</LinkRouter>
      <LinkRouter to = "/skill">Skill</LinkRouter>
    </AppBar>
  )
}

export default Navbar;
