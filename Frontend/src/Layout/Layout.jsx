import React from "react";
import { BrowserRouter , Routes, Route, Link } from "react-router-dom";
import App from "../App";
import Update from "../Components/Update";
import Delete from "../Components/Delete";
import ViewAll from "../Components/ViewAll";

function Layout(){
    return (
        <BrowserRouter>
            <nav style={{margin: 10}}>
                <Link to="/" style={{marginRight: 10}}>Insert</Link>
                <Link to="/ViewAll" style={{marginRight: 10}}>View All</Link>
                <Link to="/Update" style={{marginRight: 10}}>Update</Link>
                <Link to="/Delete">Delete</Link>
            </nav>
            <Routes>
                <Route path="/" element={<App />} />
                <Route path="/ViewAll" element={<ViewAll />} />
                <Route path="/Update" element={<Update />} />
                <Route path="/Delete" element={<Delete />} />
            </Routes>
        </BrowserRouter>
    )
}
export default Layout;