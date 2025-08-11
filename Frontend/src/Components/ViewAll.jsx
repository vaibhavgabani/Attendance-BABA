import React, { useState, useEffect } from 'react';
import axios from "axios";

function ViewAll() {
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        fetchStudents();
    }, []);

    const fetchStudents = () => {
        setLoading(true);
        axios.get('http://localhost:8000/api/students')
            .then((response) => {
                setStudents(response.data);
                setLoading(false);
            })
            .catch((error) => {
                console.log(error);
                setError('Failed to fetch students data');
                setLoading(false);
            });
    };

    const handleRefresh = () => {
        fetchStudents();
    };

    if (loading) {
        return <div>Loading students...</div>;
    }

    if (error) {
        return (
            <div>
                <h2>Error: {error}</h2>
                <button onClick={handleRefresh}>Try Again</button>
            </div>
        );
    }

    return (
        <div style={{ color: 'black' }}>
            <h2>All Students Records</h2>
            <div style={{ marginBottom: '20px' }}>
                <p><strong>Total Students: {students.length}</strong></p>
                <button onClick={handleRefresh} style={{ padding: '8px 16px', backgroundColor: '#007bff', color: 'white', border: 'none', borderRadius: '4px', cursor: 'pointer' }}>
                    Refresh Data
                </button>
            </div>

            {students.length === 0 ? (
                <p>No students found. Add some students first!</p>
            ) : (
                <div style={{ display: 'grid', gap: '15px' }}>
                    {students.map((student) => (
                        <div key={student.id} style={{
                            border: '1px solid #ddd',
                            padding: '15px',
                            borderRadius: '8px',
                            backgroundColor: '#f9f9f9',
                            color: 'black'
                        }}>
                            <div style={{ marginBottom: '5px' }}>
                                <strong>ID:</strong> {student.id}
                            </div>
                            <div style={{ marginBottom: '5px' }}>
                                <strong>Name:</strong> {student.name}
                            </div>
                            <div style={{ marginBottom: '5px' }}>
                                <strong>Email:</strong> {student.email}
                            </div>
                            <div style={{ marginBottom: '5px' }}>
                                <strong>Course:</strong> {student.course}
                            </div>
                            {student.created_at && (
                                <div style={{ marginBottom: '5px', fontSize: '0.9em', color: 'black' }}>
                                    <strong>Created:</strong> {new Date(student.created_at).toLocaleString()}
                                </div>
                            )}
                            {student.updated_at && (
                                <div style={{ fontSize: '0.9em', color: 'black' }}>
                                    <strong>Updated:</strong> {new Date(student.updated_at).toLocaleString()}
                                </div>
                            )}
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

export default ViewAll;
