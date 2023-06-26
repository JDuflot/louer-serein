import Logo from '../../assets/logo/clean-house.png'
import React from "react"
import { Link } from 'react-router-dom'

function Footer() {
    return(
<>
        <footer className="div-footer">
            <div className='div-title'>
            <p className="link"><Link className="link" to="/">Politique de confidentialité</Link></p>
            </div>
            <div className='logo'> 
                <img src={Logo} alt="footer"/>
                <p>© 2023 Louer Serein All rights reserved</p>
            </div>
            <div className='div-title'>
                <p className="link"><Link className="link" to="/">Mentions légales</Link></p>
            </div>
        </footer>
</>
    )
}
export default Footer