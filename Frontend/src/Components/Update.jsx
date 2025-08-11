import React from "react";
import { useState, useEffect } from 'react';
import axios from "axios";

function Update() {
  
  const [data,setData] = useState([]);
  const [name,setName] = useState('');
  const [email,setEmail] = useState('');
  const [id,setId] = useState('');
  const [varified, setVerified] = useState(false);
  const[course, setCourse] = useState('');

  const studentObj = {
    name, 
    email,
    course
  }

  
  const UpdateStudent = (e) => {
    if (!name.trim() || !email.trim() || !course.trim()) {
      alert("Name, Email and Course cannot be empty.");
      return;
    }
    // e.preventDefault();
    axios.put(`http://localhost:8000/api/students/${id}`, studentObj)
      .then(response => {
        setData(data.concat(response.data));
        setName('');
        setEmail('');
        setCourse('');
        setVerified(false);
        console.log("Data Update Successfully...");
      })
      .catch(error => console.log( "Update Has Been Not Done...", error));
  };
  
  const searchStudent = () => {
    axios.get(`http://localhost:8000/api/students/${id}`)
    .then(response => {
        setName(response.data.name)
        setEmail(response.data.email)
        setCourse(response.data.course)
        setVerified(true);
        console.log("Id Verified...");
    })
    .catch(error => console.log("Studen Not Found...",error));
  };

    return (
    <div>
      <h2>Update Student Data</h2>

        <label>ID : </label><input
          type="text"
          value={id}
          onChange={e => {setId(e.target.value)}}
        />
        <button onClick={searchStudent} style={{padding:5, backgroundColor: "blue" ,color:"white", marginLeft:10 }}>Verify</button><br /><br />

      <label>Name : </label><input 
        type="text" 
        value={name}
        onChange={e => {setName(e.target.value)}}
        disabled={!varified}
      /><br />

      <label>Email : </label><input type="email" 
        value={email}
        onChange={e => {setEmail(e.target.value)}}
        disabled={!varified}
      /><br /><br />

      <label>Course : </label><input 
        type="text"  
        value={course}
        onChange={e => {setCourse(e.target.value)}}
        disabled={!varified}        
      /><br /><br />

     <button onClick={UpdateStudent}>Update Student Data</button>

    </div>
  );
}

export default Update;
