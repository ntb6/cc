import React, { Component } from 'react';
import styles from './expandedjob.css';
import {Helmet} from 'react-helmet';

class App extends Component {

    constructor(props){
        super(props);
        this.state={
            items: [],
            isLoaded: false,
        }
    }

componentDidMount(){

    fetch('https://ytb55u3gmg.execute-api.us-east-1.amazonaws.com/expandJob')
    .then(res => res.json())
    .then(json => {
        this.setState({
            isLoaded: true,
            items: json,
        })
    });
}
render(){

var { isLoaded, items} = this.state;

if (!isLoaded) {
    return <div>Loading...</div>
}
else{
    return(
        <div className="Dude"  >
                {/* Data has been loaded */}
                
                <Helmet>
                <style>{
                'body { background-color: #eeeeee ; }'
                }</style>
            </Helmet>
            
                <ul className={styles}>
                    <h2 className="title">Jobs you're interested in... and how well you match.</h2>
                    
                    {items.map(item => (
                       <li key={item.id}>
                    
                      {/* <h3><b>{item.jobID}  </b>  {item.title}</h3>  */}

                      <h3 class='checkbox'><input type="checkbox"/> {item.title}</h3> 

                      <b>Salary:</b> 
                      <b></b> {item.salary} 
                      <br></br>
                      <br></br>
                      <b>Description:</b> 
                      <b></b> {item.description} 
                      <br></br>
                      <br></br>
                      <b>Location:</b> 
                      <b></b> {item.location}
                      <br></br>           
                      <b>Years of Experience:</b> 
                      <b></b> {item.yearsexp} 
                      <br></br>
                      <b>Skills Required:</b> 
                      <b></b> {item.skills}
                      <br></br>
                      <b>Turnover:</b> 
                      <b></b> {item.turnover}
                      <br></br>
                      <b>Quality of Life:</b> 
                      <b></b> {item.worklife}/100
                      <br></br>
                      <b>Percentage Match:</b> 
                      <b></b> {item.percentage}%
                      <br></br>
                      <br></br>
                       {/* ----------------------------------------------------------------------------------------------------------  */}
                       
<hr  style={{
    color: 'red',
    backgroundColor: 'red',
    height: .5,
    borderColor : 'red'
}}/>
                       </li>
                    ))}
                </ul>
                <br></br>
                <a href="http://icimsproject.s3-website.us-east-2.amazonaws.com/" target="_top">Apply to selected job(s)
                </a>
<br></br>
&#8205;
<br></br>
&#8205;
        </div>
        
    );
}
}

}

export default App;

