import React, { useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import Home from '../pages/Home';
import About from '../pages/About';
import Housing from '../pages/Housing';
import Error from '../components/Error/Error';
import Footer from '../components/Footer/Footer';
import Header from '../components/Header/Header';
import AuthContext from '../Contexts/AuthContext';
import Loader from '../pages/Loader';

const getUserFromLocalStorage = () => JSON.parse(localStorage.getItem('user')) || null;

function AllRoutes() {
    const [currentUser, setCurrentUser] = useState(getUserFromLocalStorage());
    const logout = () => {
        setCurrentUser(null);
        localStorage.removeItem('user');
    }

    return (
        <AuthContext.Provider value={{ currentUser, setCurrentUser, logout }}>
            <Router>
                <Header/>
                <Routes>
            {/* crée les routes pour chaque url */}
                    <Route path ="/" element={<Home/>}/>
                    <Route path ="/about" element={<About/>}  />
                    <Route path ="/login" element={<Loader/>}  />
                    <Route path ="/logout" element={<Loader/>}  />
                    <Route path ="/housing/:housingId" element={<Housing/>}/>
                    <Route path ="*" element={<Error/>}/>
                </Routes>
                <Footer/>
            </Router>
        </AuthContext.Provider>

    )
}
export default AllRoutes
