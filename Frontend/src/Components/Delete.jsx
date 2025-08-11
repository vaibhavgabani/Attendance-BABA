import React from "react";
import { useState, useEffect } from 'react';
import axios from "axios";

function Delete(){
    
    const [data,setData] = useState([]);
    const [id,setId] = useState('');
    //const [verified,setVerified] = useState('');

    const studentObj = {
        id
    }

    const deleteStudent = () => {
        if (!id.trim()) {
            alert("ID cannot be empty.");
            return;
        }
        axios.delete(`http://localhost:8000/api/students/${id}`)
        .then(response => {
            setData(data.filter(student => student.id !== id));
            setId('');
            console.log("Data Deleted Successfully...");
        })
        .catch(error => console.log("Delete Has Been Not Done...", error));
    };

    
    return (
        <>
            <h2>Delete Student Data</h2>

            <label>ID : </label><input
                type="text"
                value={id}
                onChange={e => {setId(e.target.value)}}
            /><br /><br />

            <button onClick={deleteStudent}>Delete Student Data</button>
            
        </>
    )
}

export default Delete;