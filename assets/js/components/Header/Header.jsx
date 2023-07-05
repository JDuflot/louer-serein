import { Link, redirect  } from "react-router-dom"
import Logo from '../../assets/logo/clean-house.png'
import Home from "../../pages/Home"
import React, { useContext, useState } from 'react';
import AuthContext from "../../Contexts/AuthContext";

function Header() {
  const auth = useContext(AuthContext);
    const handleLogin = () => {
        window.location.href="/login";
    };

    const handleLogout = () => {
      auth.logout();
      window.location.href="/logout";
    };


    return(
<>

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
               {auth.currentUser ? (
                <>
                  <li className="li-nav">
                    <Link className="li-nav" reloadDocument={true} to="/user_profile">Mon compte
                    </Link>
                  </li>
                  <li className="li-nav">
                      <Link className="li-nav" reloadDocument={true} to="/chat">Messagerie
                      </Link>
                      </li>
                  <li className="li-nav" >
                    <Link className="li-nav" to="/logout" onClick={handleLogout}>Déconnexion
                    </Link>
                  </li>
                </>

              ) : (
                <>
                  <li className="li-nav">
                    <Link className="li-nav" to="/login" onClick={handleLogin}>Se connecter</Link></li>
                  <li className="li-nav"><Link className="li-nav" reloadDocument={true} to="/register">S'inscrire</Link></li>
                </>
              )}

            </ul>
        </nav>
        </div>
        </header>
      
</>
    )
}
export default Header