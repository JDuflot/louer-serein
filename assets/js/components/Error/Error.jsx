import ErrorIllustration from '../../assets/img/404.png';
import { Link } from 'react-router-dom';
import Home from '../../pages/Home';
import React from "react"

function Error() {
    return(
<>
    <div className='error'>
        <img className="error-img" src={ErrorIllustration} alt="erreur" />
        <p className="error-title">Oups! La page que vous demandez n'existe pas.</p>
        <Link to="/" className='error-link' element={<Home/>}>Retourner à la page d'accueil </Link>
    </div>
</>
    )
}
export default Error


