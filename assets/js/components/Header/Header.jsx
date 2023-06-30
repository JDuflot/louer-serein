import { Link } from "react-router-dom"
import Logo from '../../assets/logo/clean-house.png'
import Home from "../../pages/Home"
import React, { useState } from 'react';

function Header() {
    const [isLoggedIn, setIsLoggedIn] = useState(false);

    const handleLogin = () => {
        setIsLoggedIn(true);
    };

    const handleLogout = () => {
        setIsLoggedIn(false);
    };
    return(
<>
        <div id="react-navbar">
        <header className="header-nav">
        <div className="navbar">
            <div className="logo"> 
                <Link to="/" element={<Home/>}> 
                <img src={Logo} alt="logo"/>
                <h1 className="header-title">Louer Serein</h1>
                </Link>
            </div>
        <nav>
            <ul className="ul-nav">
               <li className="li-nav"><Link to="/">Accueil</Link></li>
               <li className="li-nav"><Link to="/about">A Propos</Link></li>
               {isLoggedIn ? (
                <ul className="li-deco">
                   <li className="btn btn-deconnexion" ><Link className="li-nav-deco" reloadDocument={true} to="/logout" onClick={handleLogout}>Déconnexion</Link></li>
                   <li className="btn li-nav-deco"><Link className="li-nav-co" reloadDocument={true} to="/user_profile">Mon compte</Link></li>
                   <li className="btn li-nav-deco"><Link className="li-nav-co" reloadDocument={true} to="/admin">Dashboard</Link></li>
                    <li className="btn li-nav-deco"><Link className="li-nav-deco" reloadDocument={true} to="/user_profile">Messagerie</Link></li>
                </ul>
               
              ) : (
                <ul className="li-connexion">
                  <li className="btn btn-connexion" ><Link className="li-nav-co" reloadDocument={true} to="/login" onClick={handleLogin}>Se connecter</Link></li>
                  <li className="btn btn-connexion"><Link className="li-nav-co" reloadDocument={true} to="/register">S'inscrire</Link></li>
                </ul>
              )}

            </ul>
        </nav>
        </div>
        </header>
        </div>
</>
    )
}
export default Header