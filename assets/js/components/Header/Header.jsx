import { Link } from "react-router-dom"
import Logo from '../../assets/logo/clean-house.png'
import Home from "../../pages/Home"
import React, { useState } from 'react';

function Header() {
    return(
<>
        <header className="header-nav">
            <div className="logo"> 
                <Link to="/" element={<Home/>}> 
                <img src={Logo} alt="logo"/>
                <h1 className="header-title">Louer Serein</h1>
                </Link>
            </div>
        <nav>
            <ul className="ul-nav">
               <li><Link to="/">Accueil</Link></li>
               <li><Link to="/about">A Propos</Link></li>
               <li><Link to="/">Mon profil</Link></li>
               <li><Link to="/">Se connecter</Link></li>
            </ul>
        </nav>
        </header>
</>
    )
}
export default Header