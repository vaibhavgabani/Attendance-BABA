import { useState,useEffect} from 'react'
import axios from "axios";
import './App.css'

function App() {
  
  const [data,setData] = useState([]);
  const [name,setName] = useState(''); 
  const [email,setEmail] = useState('');
  const [course,setCourse] = useState('');

  useEffect(() => {
    axios.get('http://localhost:8000/api/students')
    .then((response) => {setData(response.data)
    })
    .catch((error) => {
      console.log(error);
    })
  },[]);

  const studentObj = {
    name, 
    email,
    course
  }

  const handleAddStudent = (e) => {
    e.preventDefault();
    axios.post('http://localhost:8000/api/students', studentObj)
      .then(response => {
        setData(data.concat(response.data));
        setName('');
        setEmail('');
        setCourse('');
      })
      .catch(error => console.log(error));
  };

  return (
    <>
      <h2>Student Deshbord</h2>

      <p>Student: {data.length}</p>

      {/* {data.map((student) => (
        <div key={student.id}>
          <h3>{student.name}</h3>
          <h3>{student.email}</h3>
          <h3>{student.created_at}</h3>
          <h3>{student.updated_at}</h3>
        </div>
      ))} */}

      <label>Name : </label><input 
        type="text" 
        value={name}
        onChange={e => {setName(e.target.value)}}
      /><br />

      <label>Email : </label><input type="email" 
        value={email}
        onChange={e => {setEmail(e.target.value)}}
      /><br />

      <label>Course : </label><input type="text" 
        value={course}
        onChange={e => {setCourse(e.target.value)}}
      /><br /><br />

     <button onClick={handleAddStudent}>Add Student Data</button>      
    </>
  )
}

export default App
