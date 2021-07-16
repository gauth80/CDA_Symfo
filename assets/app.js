import React from 'react';
import {BrowserRouter as Router, Route, Switch, Redirect} from 'react-router-dom';
// Pages
/*import Skill from "./pages/Skill";
import Contact from "./pages/Contact";
import Error from "./pages/Error";
import Home from "./pages/Home";*/
// components tiers
import Navbar from "./components/navbar/Navbar";

const App = ()=> {
  return (
    <Router>
      <Navbar/>
      <Switch>
        <Redirect exact from="/" to="/home"/>
        <Route path="/home">
          <Home/>
        </Route>
        <Route path="/skill" component={Skill}/>
        <Route path="/contact" component={Contact}/>
        <Route component={Error}/>
      </Switch>
    </Router>
  )
}

export default App;
