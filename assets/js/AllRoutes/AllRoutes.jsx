import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import Home from '../pages/Home';
import About from '../pages/About';
import Housing from '../pages/Housing';
import Error from '../components/Error/Error';
import Footer from '../components/Footer/Footer';
import Header from '../components/Header/Header';

function AllRoutes() {
    return (
        <>
        <Router>
           <Header/>
            <Routes>
          {/* crée les routes pour chaque url */}
                <Route path ="/" element={<Home/>}/>
                <Route path ="/about" element={<About/>}  />
                <Route path ="/housing/:housingId" element={<Housing/>}/>
                <Route path ="*" element={<Error/>}/>
            </Routes>
            <Footer/>
        </Router>
        </>
    )
}
export default AllRoutes
